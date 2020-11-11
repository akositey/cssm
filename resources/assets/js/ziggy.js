    var Ziggy = {
        namedRoutes: {"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"forgot-password","methods":["POST"],"domain":null},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"reset-password","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"],"domain":null},"user-password.update":{"uri":"user\/password","methods":["PUT"],"domain":null},"password.confirm":{"uri":"user\/confirm-password","methods":["GET","HEAD"],"domain":null},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"],"domain":null},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"],"domain":null},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"],"domain":null},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"],"domain":null},"current-user.destroy":{"uri":"user","methods":["DELETE"],"domain":null},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"],"domain":null},"api-tokens.index":{"uri":"user\/api-tokens","methods":["GET","HEAD"],"domain":null},"api-tokens.store":{"uri":"user\/api-tokens","methods":["POST"],"domain":null},"api-tokens.update":{"uri":"user\/api-tokens\/{token}","methods":["PUT"],"domain":null},"api-tokens.destroy":{"uri":"user\/api-tokens\/{token}","methods":["DELETE"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"survey.index":{"uri":"survey","methods":["GET","HEAD"],"domain":null},"survey.create":{"uri":"survey\/create","methods":["GET","HEAD"],"domain":null},"survey.store":{"uri":"survey","methods":["POST"],"domain":null},"survey.show":{"uri":"survey\/{survey}","methods":["GET","HEAD"],"domain":null},"survey.edit":{"uri":"survey\/{survey}\/edit","methods":["GET","HEAD"],"domain":null},"survey.update":{"uri":"survey\/{survey}","methods":["PUT","PATCH"],"domain":null},"survey.destroy":{"uri":"survey\/{survey}","methods":["DELETE"],"domain":null},"dashboard":{"uri":"admin\/dashboard","methods":["GET","HEAD"],"domain":null},"offices.restore":{"uri":"admin\/offices\/{office}\/restore","methods":["PUT"],"domain":null},"offices.index":{"uri":"admin\/offices","methods":["GET","HEAD"],"domain":null},"offices.create":{"uri":"admin\/offices\/create","methods":["GET","HEAD"],"domain":null},"offices.store":{"uri":"admin\/offices","methods":["POST"],"domain":null},"offices.show":{"uri":"admin\/offices\/{office}","methods":["GET","HEAD"],"domain":null},"offices.edit":{"uri":"admin\/offices\/{office}\/edit","methods":["GET","HEAD"],"domain":null},"offices.update":{"uri":"admin\/offices\/{office}","methods":["PUT","PATCH"],"domain":null},"offices.destroy":{"uri":"admin\/offices\/{office}","methods":["DELETE"],"domain":null},"services.index":{"uri":"admin\/services","methods":["GET","HEAD"],"domain":null},"services.create":{"uri":"admin\/services\/create","methods":["GET","HEAD"],"domain":null},"services.store":{"uri":"admin\/services","methods":["POST"],"domain":null},"services.show":{"uri":"admin\/services\/{service}","methods":["GET","HEAD"],"domain":null},"services.edit":{"uri":"admin\/services\/{service}\/edit","methods":["GET","HEAD"],"domain":null},"services.update":{"uri":"admin\/services\/{service}","methods":["PUT","PATCH"],"domain":null},"services.destroy":{"uri":"admin\/services\/{service}","methods":["DELETE"],"domain":null},"questions.index":{"uri":"admin\/questions","methods":["GET","HEAD"],"domain":null},"questions.create":{"uri":"admin\/questions\/create","methods":["GET","HEAD"],"domain":null},"questions.store":{"uri":"admin\/questions","methods":["POST"],"domain":null},"questions.show":{"uri":"admin\/questions\/{question}","methods":["GET","HEAD"],"domain":null},"questions.edit":{"uri":"admin\/questions\/{question}\/edit","methods":["GET","HEAD"],"domain":null},"questions.update":{"uri":"admin\/questions\/{question}","methods":["PUT","PATCH"],"domain":null},"questions.destroy":{"uri":"admin\/questions\/{question}","methods":["DELETE"],"domain":null},"feedback.index":{"uri":"admin\/feedback","methods":["GET","HEAD"],"domain":null},"feedback.create":{"uri":"admin\/feedback\/create","methods":["GET","HEAD"],"domain":null},"feedback.store":{"uri":"admin\/feedback","methods":["POST"],"domain":null},"feedback.show":{"uri":"admin\/feedback\/{feedback}","methods":["GET","HEAD"],"domain":null},"feedback.edit":{"uri":"admin\/feedback\/{feedback}\/edit","methods":["GET","HEAD"],"domain":null},"feedback.update":{"uri":"admin\/feedback\/{feedback}","methods":["PUT","PATCH"],"domain":null},"feedback.destroy":{"uri":"admin\/feedback\/{feedback}","methods":["DELETE"],"domain":null},"comments.edit":{"uri":"admin\/feedback\/{feedback}\/comments\/edit","methods":["GET","HEAD"],"domain":null},"comments.store":{"uri":"admin\/feedback\/{feedback}\/comments","methods":["PATCH"],"domain":null},"export.create":{"uri":"tools\/export","methods":["GET","HEAD"],"domain":null},"export.check":{"uri":"tools\/checkPassCode","methods":["POST"],"domain":null},"export":{"uri":"tools\/export","methods":["POST"],"domain":null},"import":{"uri":"tools\/import","methods":["POST"],"domain":null}},
        baseUrl: 'http://pgom-css.test/',
        baseProtocol: 'http',
        baseDomain: 'pgom-css.test',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
