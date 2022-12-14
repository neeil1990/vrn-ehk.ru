;(function() {
	"use strict";

	BX.namespace("BX.Landing");

	var data = BX.Landing.Utils.data;

	/**
	 * @extends {BX.Landing.Block.Node}
	 * @param options
	 * @constructor
	 */
	BX.Landing.Block.Node.Embed = function(options)
	{
		BX.Landing.Block.Node.apply(this, arguments);
		this.type = 'embed';
		this.attribute = ['data-src', 'data-source', 'data-preview'];
		this.onAttributeChangeHandler = options.onAttributeChange || (function() {});
		this.lastValue = this.getValue();
	};


	BX.Landing.Block.Node.Embed.prototype = {
		constructor: BX.Landing.Block.Node.Embed,
		__proto__: BX.Landing.Block.Node.prototype,

		onChange: function()
		{
			this.lastValue = this.getValue();
			this.onAttributeChangeHandler(this);
			this.onChangeHandler(this);
		},

		isChanged: function()
		{
			return JSON.stringify(this.getValue()) !== JSON.stringify(this.lastValue);
		},

		getValue: function()
		{
			return {
				src: this.node.src ? this.node.src : data(this.node, "data-src"),
				source: data(this.node, "data-source"),
				preview: data(this.node, "data-preview")
			};
		},

		setValue: function(value, preventSave, preventHistory)
		{
			// if iframe or preview-div
			if(this.node.src)
			{
				this.node.src = value.src;
			}
			else
			{
				data(this.node, "data-src", value.src)
			}

			data(this.node, "data-source", value.source);
			if(value.preview)
			{
				data(this.node, "data-preview", value.preview);
				this.node.style.backgroundImage = "url(\""+value.preview+"\")";
			}
			else
			{
				data(this.node, "data-preview", null);
				this.node.style.backgroundImage = "";
			}

			if (this.isChanged())
			{
				if (!preventHistory)
				{
					BX.Landing.History.getInstance().push(
						new BX.Landing.History.Entry({
							block: this.getBlock().id,
							selector: this.selector,
							command: "editEmbed",
							undo: this.lastValue,
							redo: this.getValue()
						})
					);
				}

				this.onChange();
			}
		},

		getField: function()
		{
			const fieldData = {
				title: this.manifest.name,
				selector: this.selector,
				content: this.getValue()
			};
			if (BX.Dom.hasClass(this.node.parentNode, 'bg-video__inner'))
			{
				return new BX.Landing.UI.Field.EmbedBg(fieldData);
			}

			return new BX.Landing.UI.Field.Embed(fieldData);
		}
	};

})();