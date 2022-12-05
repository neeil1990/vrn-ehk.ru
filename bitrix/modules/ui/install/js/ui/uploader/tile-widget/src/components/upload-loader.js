import { BitrixVue } from 'ui.vue';
import { ProgressRound } from 'ui.progressround';

export const UploadLoader = BitrixVue.localComponent('tile-uploader.uploader-loader', {
	props: {
		progress: {
			type: Number,
			default: 0,
		},
		width: {
			type: Number,
			default: 45,
		},
		lineSize: {
			type: Number,
			default: 3,
		},
		colorTrack: {
			type: String,
			default: '#eeeff0',
		},
		colorBar: {
			type: String,
			default: '#2fc6f6',
		},
		rotation: {
			type: Boolean,
			default: true,
		},
	},
	data()
	{
		return {
			loader: null,
		}
	},
	mounted()
	{
		this.createProgressbar();
	},
	watch: {
		progress()
		{
			this.updateProgressbar();
		},
	},
	methods: {
		createProgressbar()
		{
			this.loader = new ProgressRound({
				width: this.width,
				lineSize: this.lineSize,
				colorBar: this.colorBar,
				colorTrack: this.colorTrack,
				rotation: this.rotation,
				value: this.progress,
				color: ProgressRound.Color.SUCCESS,
			});

			this.loader.renderTo(this.$refs.container);
		},
		updateProgressbar()
		{
			if (!this.loader)
			{
				this.createProgressbar();
			}

			this.loader.update(this.progress);
		},
	},
	template: `<span ref="container"></span>`
});
