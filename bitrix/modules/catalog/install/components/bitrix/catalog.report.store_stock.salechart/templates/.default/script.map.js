{"version":3,"sources":["script.js"],"names":["exports","currency","main_core","StoreStockSaleChart","params","babelHelpers","classCallCheck","this","defineProperty","_chartId","chartId","_boardId","boardId","_widgetId","widgetId","_board","BX","VisualConstructor","BoardRepository","getBoard","_widget","dashboard","getWidget","_storeInfoPopupTemplate","storeInfoPopupTemplate","_storeInfoPopup","_sliderUrl","chartData","sliderUrl","_enablePopup","Boolean","enablePopup","_currencySymbol","currencySymbol","_chartCurrency","_isOneColumn","isOneColumn","createChart","updateWidgetTitle","addCustomEvent","bind","createClass","key","value","_this","window","am4core","useTheme","am4themes_animated","_chart","create","am4charts","XYChart","zoomOutButton","readerTitle","Loc","getMessage","data","legend","Legend","position","_chartLabel","createAxes","fillChartData","fillSeries","_categoryAxis","renderer","labels","template","html","chartLabel","events","on","onChartLoaded","xAxes","push","CategoryAxis","dataFields","category","grid","opacity","_valueAxis","yAxes","ValueAxis","min","ticks","strokeOpacity","length","line","baseGrid","disabled","minGridDistance","calculateTotals","marginRight","map","columnData","index","_this2","emptySeries","createSeries","hiddenInLegend","maskBullets","sumStoredTitle","sumStoredSeries","fill","color","_sumStoredColor","stroke","_series","sumSoldTitle","sumSoldSeries","_sumSoldColor","eventObject","onSeriesLoad","target","seriesObject","seriesTypeId","values","prepareChartLegend","bindPopupEvents","i","columns","column","columnObject","getIndex","columnTypeId","storeData","group","node","handleColumnMouseOver","handleColumnMouseOut","style","cursor","openStoreStockChartGridSlider","_legendIsPrepared","chartLegends","currencyPostfix","currentText","openStoreInfoPopup","close","SidePanel","Instance","open","cacheable","allowChangeTitle","allowChangeHistory","destroy","popupData","typeId","PopupWindow","bindOptions","offsetLeft","offsetTop","noAllPaddings","autoHide","draggable","restrict","content","getFormedStoreInfoPopupContent","show","popup","title","querySelector","sum","sumProc","innerText","innerHTML","sumCurrencyFormat","formatPercentValue","borderColor","parseFloat","Currency","currencyFormat","percentValue","toFixed","field","name","series","ColumnSeries","valueY","categoryX","stacked","clean","layout","titleContainer","adjust","children","text","config","_hint","UI","Hint","createNode","top","Helper","fillColumnsTitle","dataItemsByCategory","getKey","_this3","forEach","Reflection","namespace"],"mappings":"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","file":"script.map.js"}