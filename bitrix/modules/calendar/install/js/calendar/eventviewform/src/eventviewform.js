"use strict";

import { Util } from 'calendar.util';
import { Type, Event, Loc, Dom, Runtime, Text } from 'main.core';
import { Entry, EntryManager } from 'calendar.entry';
import { MeetingStatusControl } from 'calendar.controls';
import { BaseEvent, EventEmitter } from 'main.core.events';
import { Planner } from 'calendar.planner';
import { ControlButton } from 'intranet.control-button';
import { BitrixVue } from 'ui.vue3';
import { ViewEventSlider } from './view-event-slider';
import { CalendarSection } from 'calendar.sectionmanager';

export class EventViewForm {
	permissions = {};
	name = 'eventviewform';
	uid = null;
	DOM = {};
	RELOAD_REQUESTED = 'RELOAD_REQUESTED';
	RELOAD_FINISHED = 'RELOAD_FINISHED';
	reloadStatus = null;
	entityChanged = false;
	LOAD_DELAY = 500;
	app = null;

	constructor(options = {})
	{
		this.type = options.type || 'user';
		this.ownerId = options.ownerId || 0;
		this.userId = options.userId || 0;
		this.zIndex = 3100;
		this.entryId = options.entryId || null;
		this.calendarContext = options.calendarContext || null;
		this.entryDateFrom = options.entryDateFrom || null;
		this.timezoneOffset = options.timezoneOffset || null;
		this.BX = Util.getBX();

		this.sliderOnLoad = this.onLoadSlider.bind(this);
		this.showUserListPopupBind = this.showUserListPopup.bind(this);
		this.keyHandlerBind = this.keyHandler.bind(this);
		this.destroyBind = this.destroy.bind(this);

		this.loadPlannerDataDebounce = Runtime.debounce(this.loadPlannerData, this.LOAD_DELAY, this);

		this.pullEventList = new Set();
	}

	initInSlider(slider, promiseResolve)
	{
		this.slider = slider;
		EventEmitter.subscribe(slider, "SidePanel.Slider:onLoad", this.sliderOnLoad);
		EventEmitter.subscribe(slider, "SidePanel.Slider:onCloseComplete", this.destroyBind);
		Event.bind(document, 'keydown', this.keyHandlerBind);

		this.createContent(slider).then(function(html)
			{
				if (Type.isFunction(promiseResolve))
				{
					promiseResolve(html);
				}
			}.bind(this)
		);

		this.opened = true;
	}

	isOpened()
	{
		return this.opened;
	}

	destroy()
	{
		EventEmitter.unsubscribe(this.slider, "SidePanel.Slider:onLoad", this.sliderOnLoad);
		EventEmitter.unsubscribe(this.slider, "SidePanel.Slider:onCloseComplete", this.destroyBind);
		Event.unbind(document, 'keydown', this.keyHandlerBind);
		this.app.unmount();

		if (this.intranetControllButton && this.intranetControllButton.destroy)
		{
			this.intranetControllButton.destroy();
		}

		Util.closeAllPopups();
		this.opened = false;
	}

	onLoadSlider(event)
	{
		if (!event instanceof BaseEvent)
		{
			return;
		}
		const data = event.getData();
		const slider = data[0]?.slider;

		this.DOM.content = slider.layout.content;

		// Used to execute javasctipt and attach CSS from ajax responce
		this.BX.html(slider.layout.content, slider.getData().get("sliderContent"));
		if (!Type.isNull(this.uid))
		{
			this.initControls(this.uid);
		}

		this.reloadStatus = this.RELOAD_FINISHED;
	}

	loadComponentAssets(json)
	{
		if (!json)
		{
			return;
		}
		let assets = JSON.parse(json).data.assets;
		let promise = new Promise(function(resolve, reject) {
			let css = assets.css;
			BX.load(css, function() {
				BX.loadScript(assets.js, resolve);
			});
		});
		promise.then(function() {
			let strings = assets.string;
			let stringAsset = strings.join('\n');
			BX.html(document.head, stringAsset, { useAdjacentHTML: true });
		});
	}

	createContent(slider)
	{
		return new Promise((resolve) => {
			this.BX.ajax.runAction('calendar.api.calendareventviewform.getCalendarViewSliderParams', {
				analyticsLabel: {calendarAction: 'view_event', formType: 'full'},
				data: {
					entryId: this.entryId,
					dateFrom: Util.formatDate(this.entryDateFrom),
					timezoneOffset: this.timezoneOffset
				}
			}).then(response => {
				const viewEventSliderRoot = document.createElement('div');

				if ((Type.isFunction(slider.isOpen) && slider.isOpen()) || slider.isOpen === true)
				{
					let params = response.data;
					params.eventExists = !!(params.entry.ID);

					//load components' css and js
					if (params.filesView)
					{
						this.loadComponentAssets(params.filesView);
					}
					if (params.crmView)
					{
						this.loadComponentAssets(params.crmView);
						this.BX.ajax.runAction('calendar.api.calendareventviewform.getCrmView', {
							data: { event: params.event }
						});
					}

					//set vue component to slider
					this.app = BitrixVue.createApp(ViewEventSlider, {
						params: params,
						reloadPlannerCallback: this.loadPlannerDataDebounce,
						showUserListPopupCallback: this.showUserListPopupBind,
					});
					this.app.mount(viewEventSliderRoot);

					slider.sliderContent = viewEventSliderRoot;

					//set local params
					this.userId = params.userId;
					this.uid = params.id;
					this.entryUrl = params.entryUrl;
					this.userTimezone = params.userTimezone;
					this.dayOfWeekMonthFormat = params.dayOfWeekMonthFormat;
					this.plannerFeatureEnabled = !!params.plannerFeatureEnabled;
					if (this.planner && !this.plannerFeatureEnabled)
					{
						this.planner.lock();
					}
					this.handleEntryData(params.entry, params.userIndex, params.section);
				}

				resolve(viewEventSliderRoot);
			},
			response => {
				if (response.errors && response.errors.length)
				{
					slider.getData().set(
						"sliderContent",
						'<div class="calendar-slider-alert">'
						+ '<div class="calendar-slider-alert-inner">'
						+ '<div class="calendar-slider-alert-img"></div>'
						+ '<h1 class="calendar-slider-alert-text">' + Text.encode(response.errors[0].message) + '</h1>'
						+ '</div>'
						+ '</div>'
					);
				}

				this.displayError(response.errors);
				resolve(response);
			})
		});
	}

	initControls(uid)
	{
		this.DOM.title = this.DOM.content.querySelector(`#${uid}_title`);
		this.DOM.buttonSet = this.DOM.content.querySelector(`#${uid}_buttonset`);
		this.DOM.editButton = this.DOM.content.querySelector(`#${uid}_but_edit`);
		this.DOM.delButton = this.DOM.content.querySelector(`#${uid}_but_del`);
		this.DOM.sidebarInner = this.DOM.content.querySelector(`#${uid}_sidebar_inner`);

		if (this.DOM.buttonSet)
		{
			this.initPlannerControl(uid);
		}

		const innerTimeWrap = this.DOM.content.querySelector(`#${uid}_time_inner_wrap`);
		if (Type.isElementNode(innerTimeWrap) && innerTimeWrap.offsetHeight > 50)
		{
			Dom.addClass(this.DOM.content.querySelector(`#${uid}_time_wrap`), 'calendar-slider-sidebar-head-long-time');
		}

		if (this.canDo(this.entry, 'edit') && this.DOM.editButton)
		{
			Event.bind(this.DOM.editButton, 'click', () => {
				this.BX.SidePanel.Instance.close(false, function ()
				{
					EntryManager.openEditSlider({
						entry: this.entry,
						type: this.type,
						ownerId: this.ownerId,
						userId: this.userId
					});
				}.bind(this));
			});
		}
		else
		{
			this.BX.remove(this.DOM.editButton);
		}

		if (this.DOM.sidebarInner)
		{
			// Reminder
			this.DOM.reminderWrap = this.DOM.sidebarInner.querySelector('.calendar-slider-sidebar-remind-wrap');
			if (Type.isDomNode(this.DOM.reminderWrap))
			{
				Dom.clean(this.DOM.reminderWrap);
				let viewMode = !this.canDo(this.entry, 'edit')
					&& this.entry.getCurrentStatus() === false;

				this.reminderControl = new this.BX.Calendar.Controls.Reminder({
					wrap: this.DOM.reminderWrap,
					zIndex: this.zIndex,
					viewMode: viewMode
				});
				this.reminderControl.setValue(this.entry.getReminders());

				if (!viewMode)
				{
					this.reminderControl.subscribe('onChange', (event) => {
						if (event instanceof BaseEvent)
						{
							this.handleEntityChanges();
							this.reminderValues = event.getData().values;
							this.BX.ajax.runAction('calendar.api.calendarajax.updateReminders', {
								data: {
									entryId: this.entry.id,
									userId: this.userId,
									reminders: this.reminderValues
								}
							});
						}
					});
				}
			}

			let items = this.DOM.sidebarInner.querySelectorAll('.calendar-slider-sidebar-border-bottom');
			if (items.length >= 2)
			{
				this.BX.removeClass(items[items.length - 1], 'calendar-slider-sidebar-border-bottom');
			}
		}
		if (this.canDo(this.entry, 'delete'))
		{
			Event.bind(this.DOM.delButton, 'click', ()=>{
				EventEmitter.subscribeOnce('BX.Calendar.Entry:beforeDelete', ()=>{
					this.BX.SidePanel.Instance.close();
				});
				EntryManager.deleteEntry(this.entry, this.calendarContext);
			});
		}
		else
		{
			this.BX.remove(this.DOM.delButton);
		}

		this.BX.viewElementBind(
			uid + '_' + this.entry.id + '_files_wrap',
			{
				showTitle: true
			},
			function(node)
			{
				return Type.isElementNode(node) && (node.getAttribute('data-bx-viewer') || node.getAttribute('data-bx-image'));
			}
		);

		if (this.entry && this.entry.isMeeting())
		{
			this.initAcceptMeetingControl(uid);
		}

		if (this.DOM.sidebarInner)
		{
			let items = this.DOM.sidebarInner.querySelectorAll('.calendar-slider-sidebar-border-bottom');
			if (items.length >= 2)
			{
				this.BX.removeClass(items[items.length - 1], 'calendar-slider-sidebar-border-bottom');
			}
		}

		this.DOM.copyButton = this.DOM.content.querySelector(`#${uid}_copy_url_btn`);
		if (this.DOM.copyButton)
		{
			Event.bind(this.DOM.copyButton, 'click', this.copyEventUrl.bind(this));
		}

		// Init "Videocall" control
		this.DOM.videoCall = this.DOM.sidebarInner.querySelector('.calendar-slider-sidebar-videocall');
		Dom.clean(this.DOM.videoCall);
		if (
			BX?.Intranet?.ControlButton
			&& Type.isElementNode(this.DOM.videoCall)
			&& this.entry.getCurrentStatus() !== false
		)
		{
			this.DOM.videoCall.style.display = '';
			this.intranetControllButton = new ControlButton({
				container: this.DOM.videoCall,
				entityType: 'calendar_event',
				entityId: this.entry.parentId,
				entityData: {
					dateFrom: Util.formatDate(this.entry.from),
					parentId: this.entry.parentId
				},
				analyticsLabel: {
					formType: 'full'
				}
			});
		}
		else
		{
			this.DOM.videoCall.style.display = 'none';
		}
	}

	handleEntryData(entryData, userIndex, sectionData)
	{
		this.entry = new Entry({data: entryData, userIndex: userIndex});
		this.section = new CalendarSection(sectionData);

		if (Type.isPlainObject(sectionData))
		{
			this.permissions = sectionData.PERM;
		}

		EntryManager.registerEntrySlider(this.entry, this);
	}

	initPlannerControl(uid)
	{
		this.plannerId = uid + '_view_slider_planner';
		this.DOM.plannerWrapOuter = this.DOM.content.querySelector(`.calendar-slider-detail-timeline`);
		this.DOM.plannerWrap = this.DOM.plannerWrapOuter.querySelector(`.calendar-view-planner-wrap`);
		Dom.clean(this.DOM.plannerWrap);
		this.planner = new Planner({
			wrap: this.DOM.plannerWrap,
			minWidth: parseInt(this.DOM.plannerWrap.offsetWidth),
			solidStatus: true,
			readonly: true,
			locked: !this.plannerFeatureEnabled,
			dayOfWeekMonthFormat: this.dayOfWeekMonthFormat
		});

		this.planner.show();
		this.planner.showLoader();

		setTimeout(() => {
			if (this.DOM.plannerWrapOuter)
			{
				Dom.removeClass(this.DOM.plannerWrapOuter, 'hidden');
			}
		}, 500);

		const plannerData = {
			entryId: this.entry.id || 0,
			entryLocation: this.entry.data.LOCATION || '',
			ownerId: this.ownerId,
			hostId: this.entry.getMeetingHost(),
			type: this.type,
			entityList: this.entry.getAttendeesEntityList(),
			dateFrom: Util.formatDate(this.entry.from.getTime() - Util.getDayLength() * 3),
			dateTo: Util.formatDate(this.entry.to.getTime() + Util.getDayLength() * 10),
			timezone: this.userTimezone,
			location: this.entry.getLocation(),
			entry: this.entry
		};

		this.loadPlannerDataDebounce(plannerData);
	}

	showUserListPopup(node, userList)
	{
		if (this.userListPopup)
		{
			this.userListPopup.close();
		}

		if (userList && userList.length)
		{
			this.DOM.userListPopupWrap = this.BX.create('DIV', {props: {className: 'calendar-user-list-popup-block'}});
			userList.forEach(function (user)
			{
				let userWrap = this.DOM.userListPopupWrap.appendChild(this.BX.create('DIV', {props: {className: 'calendar-slider-sidebar-user-container calendar-slider-sidebar-user-card'}}));

				userWrap.appendChild(this.BX.create('DIV', {props: {className: 'calendar-slider-sidebar-user-block-avatar'}}))
					.appendChild(this.BX.create('DIV', {props: {className: 'calendar-slider-sidebar-user-block-item'}}))
					.appendChild(this.BX.create('IMG', {props: {width: 34, height: 34, src: user.AVATAR}}));

				userWrap.appendChild(this.BX.create("DIV", {props: {className: 'calendar-slider-sidebar-user-info'}}))
					.appendChild(this.BX.create("A", {
						props: {
							href: user.URL ? user.URL : '#',
							className: 'calendar-slider-sidebar-user-info-name'
						},
						text: user.DISPLAY_NAME
					}));
			}, this);

			this.userListPopup = this.BX.PopupWindowManager.create("user-list-popup-" + Math.random(), node, {
				autoHide: true,
				closeByEsc: true,
				offsetTop: 0,
				offsetLeft: 0,
				resizable: false,
				lightShadow: true,
				content: this.DOM.userListPopupWrap,
				className: 'calendar-user-list-popup',
				zIndex: 4000
			});

			this.userListPopup.setAngle({offset: 36});
			this.userListPopup.show();
			this.BX.addCustomEvent(this.userListPopup, 'onPopupClose', ()=>{this.userListPopup.destroy();});
		}
	}

	initAcceptMeetingControl(uid)
	{
		this.DOM.statusButtonset = this.DOM.content.querySelector(`#${uid}_status_buttonset`);
		this.DOM.statusButtonset.style.marginRight = '12px';

		if (this.entry.getCurrentStatus() === 'H' || this.entry.getCurrentStatus() === false)
		{
			Dom.remove(this.DOM.statusButtonset);
		}
		else
		{
			this.statusControl = new MeetingStatusControl(
			{
				wrap: this.DOM.statusButtonset,
				currentStatus: this.DOM.content.querySelector(`#${uid}_current_status`).value || this.entry.getCurrentStatus()
			});

			this.statusControl.subscribe('onSetStatus', (event) => {
					if (event instanceof BaseEvent)
					{
						this.handleEntityChanges();
						EntryManager.setMeetingStatus(this.entry, event.getData().status)
							.then(() => {
								this.statusControl.setStatus(this.entry.getCurrentStatus(), false);
								this.statusControl.updateStatus();
							});
					}
				}
			);
		}
	}

	copyEventUrl()
	{
		if(!this.entryUrl || !this.BX.clipboard.copy(this.entryUrl))
		{
			return;
		}

		this.timeoutIds = this.timeoutIds || [];
		let popup = new this.BX.PopupWindow(
			'calendar_clipboard_copy',
			this.DOM.copyButton,
			{
				content: Loc.getMessage('CALENDAR_TIP_TEMPLATE_LINK_COPIED'),
				darkMode: true,
				autoHide: true,
				zIndex: 1000,
				angle: true,
				offsetLeft: 20,
				cachable: false
			}
		);
		popup.show();

		let timeoutId;
		while(timeoutId = this.timeoutIds.pop())
		{
			clearTimeout(timeoutId);
		}
		this.timeoutIds.push(setTimeout(function(){popup.close();}, 1500));
	}

	displayError(errors = [])
	{
		//errors
	}

	canDo(entry, action)
	{
		if ((action === 'edit' || action === 'delete'))
		{
			if (entry.isResourcebooking())
			{
				return false;
			}

			return this.section.canDo('edit');
		}

		if ((action === 'view'))
		{
			return this.permissions.view_full;
		}

		return false;
	}

	plannerIsShown()
	{
		return this.DOM.plannerWrap && Dom.hasClass(this.DOM.plannerWrap, 'calendar-edit-planner-wrap-shown');
	}

	loadPlannerData(plannerData)
	{
		return new Promise((resolve) => {
			this.BX.ajax.runAction('calendar.api.calendarajax.updatePlanner', {
				data: plannerData
			}).then((response) => {
					this.planner.hideLoader();
					this.planner.update(
						response.data.entries,
						response.data.accessibility
					);

					this.planner.updateSelector(
						Util.adjustDateForTimezoneOffset(
							plannerData.entry.from,
							plannerData.entry.userTimezoneOffsetFrom,
							plannerData.entry.fullDay),
						Util.adjustDateForTimezoneOffset(
							plannerData.entry.to,
							plannerData.entry.userTimezoneOffsetTo,
							plannerData.entry.fullDay
						),
						plannerData.entry.fullDay

					);
					resolve(response);
				},
				(response) => {resolve(response);}
			);
		});
	}

	keyHandler(e)
	{
		if(
			(
				e.keyCode === Util.getKeyCode('delete')
				// || e.keyCode === Util.getKeyCode('backspace')
			)
			&& this.canDo(this.entry, 'delete'))
		{
			const target = event.target || event.srcElement;
			const tagName = Type.isElementNode(target) ? target.tagName.toLowerCase() : null;
			if (tagName && !['input', 'textarea'].includes(tagName))
			{
				EventEmitter.subscribeOnce('BX.Calendar.Entry:beforeDelete', ()=>{
					this.BX.SidePanel.Instance.close();
				});
				EntryManager.deleteEntry(this.entry, this.calendarContext);
			}
		}
	}

	handleEntityChanges()
	{
		this.entityChanged = true;
	}
}
