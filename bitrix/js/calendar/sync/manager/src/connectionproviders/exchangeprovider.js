import {ConnectionProvider} from "./connectionprovider";
import {Loc} from "main.core";

export class ExchangeProvider extends ConnectionProvider
{
	constructor(options)
	{
		super({
			status: options.syncInfo.status || false,
			connected: options.syncInfo.connected || false,
			gridTitle: Loc.getMessage('CALENDAR_TITLE_EXCHANGE'),
			gridColor: '#54d0df',
			gridIcon: '/bitrix/images/calendar/sync/exchange.svg',
			type: 'exchange',
			viewClassification: 'web',
			templateClass: 'BX.Calendar.Sync.Interface.ExchangeTemplate',
		});
		this.connectionName = Loc.getMessage('CALENDAR_TITLE_EXCHANGE');

		this.setSyncDate(options.syncInfo.syncOffset);
		this.setSections(options.sections);
		this.setConnections();
	}

}