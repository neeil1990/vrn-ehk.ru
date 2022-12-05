{"version":3,"sources":["dropdown_field.js"],"names":["BX","namespace","setTextContent","Landing","Utils","escapeText","data","offsetTop","offsetLeft","UI","Field","Dropdown","options","this","items","BaseField","apply","arguments","setEventNamespace","subscribeFromOptions","Component","fetchEventsFromOptions","onChangeHandler","onChange","layout","classList","add","popup","input","addEventListener","onInputClick","bind","classForTextNode","document","onDocumentClick","rootWindow","PageObject","getRootWindow","hint","header","querySelector","Dom","append","top","Hint","createNode","type","isPlainObject","keys","Object","map","key","name","value","Type","isArrayFilled","Loc","getMessage","content","setValue","prototype","constructor","__proto__","event","stopPropagation","contentRoot","popupRoot","contains","popupWindow","popupContainer","menuItems","forEach","item","hidden","push","mahHeight","maxHeight","delimiter","html","text","undefined","onclick","onItemClick","className","PopupMenuWindow","id","Date","bindElement","bindOptions","forceBindPosition","targetContainer","events","onPopupClose","remove","angle","parentElement","appendChild","style","position","isShown","close","show","rect","getBoundingClientRect","left","height","width","postfix","property","onValueChangeHandler","fireEvent","emit","getValue","dataset","isChanged"],"mappings":"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","file":"dropdown_field.map.js"}