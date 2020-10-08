    var Ziggy = {
        namedRoutes: {"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"forgot-password","methods":["POST"],"domain":null},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"reset-password","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"],"domain":null},"user-password.update":{"uri":"user\/password","methods":["PUT"],"domain":null},"password.confirm":{"uri":"user\/confirm-password","methods":["GET","HEAD"],"domain":null},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"],"domain":null},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"],"domain":null},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"],"domain":null},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"],"domain":null},"current-user.destroy":{"uri":"user","methods":["DELETE"],"domain":null},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"],"domain":null},"api-tokens.index":{"uri":"user\/api-tokens","methods":["GET","HEAD"],"domain":null},"api-tokens.store":{"uri":"user\/api-tokens","methods":["POST"],"domain":null},"api-tokens.update":{"uri":"user\/api-tokens\/{token}","methods":["PUT"],"domain":null},"api-tokens.destroy":{"uri":"user\/api-tokens\/{token}","methods":["DELETE"],"domain":null},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"],"domain":null},"feedback.index":{"uri":"feedback","methods":["GET","HEAD"],"domain":null},"feedback.create":{"uri":"feedback\/create","methods":["GET","HEAD"],"domain":null},"feedback.store":{"uri":"feedback","methods":["POST"],"domain":null},"feedback.show":{"uri":"feedback\/{feedback}","methods":["GET","HEAD"],"domain":null},"feedback.edit":{"uri":"feedback\/{feedback}\/edit","methods":["GET","HEAD"],"domain":null},"feedback.update":{"uri":"feedback\/{feedback}","methods":["PUT","PATCH"],"domain":null},"feedback.destroy":{"uri":"feedback\/{feedback}","methods":["DELETE"],"domain":null},"offices.index":{"uri":"admin\/offices","methods":["GET","HEAD"],"domain":null},"offices.create":{"uri":"admin\/offices\/create","methods":["GET","HEAD"],"domain":null},"offices.store":{"uri":"admin\/offices","methods":["POST"],"domain":null},"offices.show":{"uri":"admin\/offices\/{office}","methods":["GET","HEAD"],"domain":null},"offices.edit":{"uri":"admin\/offices\/{office}\/edit","methods":["GET","HEAD"],"domain":null},"offices.update":{"uri":"admin\/offices\/{office}","methods":["PUT","PATCH"],"domain":null},"offices.destroy":{"uri":"admin\/offices\/{office}","methods":["DELETE"],"domain":null},"ips.index":{"uri":"admin\/ips","methods":["GET","HEAD"],"domain":null},"ips.create":{"uri":"admin\/ips\/create","methods":["GET","HEAD"],"domain":null},"ips.store":{"uri":"admin\/ips","methods":["POST"],"domain":null},"ips.show":{"uri":"admin\/ips\/{ip}","methods":["GET","HEAD"],"domain":null},"ips.edit":{"uri":"admin\/ips\/{ip}\/edit","methods":["GET","HEAD"],"domain":null},"ips.update":{"uri":"admin\/ips\/{ip}","methods":["PUT","PATCH"],"domain":null},"ips.destroy":{"uri":"admin\/ips\/{ip}","methods":["DELETE"],"domain":null}},
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