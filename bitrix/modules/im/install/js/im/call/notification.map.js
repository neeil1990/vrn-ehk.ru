{"version":3,"sources":["notification.js"],"names":["BX","namespace","Call","Notification","Events","onButtonClick","config","this","popup","window","callerAvatar","type","isNotEmptyString","callerName","callerType","callerColor","video","hasCamera","callbacks","onClose","isFunction","DoNothing","onDestroy","_onContentButtonClickHandler","_onContentButtonClick","bind","desktop","addCustomEvent","prototype","show","params","BXDesktopWindow","ExecuteCommand","BXDesktopSystem","getHtmlPage","JSON","stringify","content","NotificationContent","createPopup","render","PopupWindow","targetContainer","document","body","closeIcon","noAllPaddings","zIndex","MessengerCommon","getDefaultZIndex","offsetLeft","offsetTop","closeByEsc","draggable","restrict","overlay","backgroundColor","opacity","events","onPopupClose","onPopupDestroy","close","destroy","removeCustomEvents","e","message","elements","root","avatar","backgroundImage","callerPrefix","avatarClass","avatarImageClass","avatarImageStyles","backgroundSize","backgroundPosition","create","props","className","children","style","text","util","htmlspecialcharsback","click","_onAnswerWithVideoButtonClick","_onAnswerButtonClick","_onDeclineButtonClick","showInDesktop","opener","BXIM","callController","callNotification","appendChild","setWindowPosition","X","STP_CENTER","Y","STP_VCENTER","Width","Height","onCustomEvent","button"],"mappings":"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","file":"notification.map.js"}