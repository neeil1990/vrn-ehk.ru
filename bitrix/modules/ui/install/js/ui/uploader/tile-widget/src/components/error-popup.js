import { BitrixVue } from 'ui.vue';
import { Popup } from 'main.popup';
import { Type } from 'main.core';
import type { UploaderError } from 'ui.uploader.core';

export const ErrorPopup = BitrixVue.localComponent('ui.uploader.error-popup', {
	props: {
		error: {
			type: [Object, String],
		},
		alignArrow: {
			type: Boolean,
			default: true,
		},
		popupOptions: {
			type: Object,
			default()
			{
				return {};
			}
		},
	},
	data()
	{
		return {
			errorPopup: null,
		};
	},
	watch: {
		error(newValue)
		{
			if (this.errorPopup)
			{
				this.errorPopup.destroy();
			}

			this.errorPopup = this.createPopup(newValue);
			this.errorPopup.show();
		}
	},
	mounted()
	{
		if (this.error)
		{
			this.errorPopup = this.createPopup(this.error);
			this.errorPopup.show();
		}
	},
	beforeDestroy()
	{
		if (this.errorPopup)
		{
			this.errorPopup.destroy();
			this.errorPopup = null;
		}
	},
	methods: {
		createContent(error: UploaderError | string)
		{
			if (Type.isStringFilled(error))
			{
				return error;
			}
			else if (Type.isObject(error))
			{
				return error.getMessage() + '<br>' + error.getDescription();
			}

			return '';
		},

		createPopup(error: UploaderError | string)
		{
			const content = this.createContent(error);
			let defaultOptions;
			if (this.alignArrow && Type.isElementNode(this.popupOptions.bindElement))
			{
				const targetNode = this.popupOptions.bindElement;
				const targetNodeWidth = targetNode.offsetWidth;

				defaultOptions = {
					cacheable: false,
					animation: 'fading-slide',
					content,
					// minWidth: 300,
					events: {
						onDestroy: () => {
							this.$emit('onDestroy', error);
							this.errorPopup = null;
						},
						onShow: function(event) {
							const popup = event.getTarget();
							popup.getPopupContainer().style.display = 'block';

							const popupWidth = popup.getPopupContainer().offsetWidth;
							const offsetLeft = (targetNodeWidth / 2) - (popupWidth / 2);
							const angleShift = Popup.getOption('angleLeftOffset') - Popup.getOption('angleMinTop');

							popup.setAngle({ offset: popupWidth / 2 - angleShift });
							popup.setOffset({ offsetLeft: offsetLeft + Popup.getOption('angleLeftOffset') });
						}
					}
				};
			}
			else
			{
				defaultOptions = {
					cacheable: false,
					animation: 'fading-slide',
					content,
					events: {
						onDestroy: () => {
							this.$emit('onDestroy', error);
							this.errorPopup = null;
						},
					}
				};
			}

			const options = Object.assign({}, defaultOptions, this.popupOptions);

			return new Popup(options);
		}
	},
	template: '<span></span>',
});
