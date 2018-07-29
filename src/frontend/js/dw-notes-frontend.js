(function ($, ajax_data) {
    'use strict';

    var dw_notes = {
        config: {
            url_base: location.protocol +'//' + location.host,
            url_route: ajax_data.route,
            url_endpoint: ajax_data.endpoint
        },
        init: function () {
            var _t=this, _c=_t.config;
           _t.request('', 'get', null);
           //_t.request('/163', 'post', {'title': 'note title'});

        },
        bind: function () {
        },
        request: function(url, type, data){
            var _t=this, _c=_t.config,
                r = $.ajax({
                    url: _c.url_base  + '/' + _c.url_route + '/' + _c.url_endpoint + url,
                    type: type,
                    dataType: 'json',
                    data: data,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", "Basic " + btoa(ajax_data.username + ":" + ajax_data.password));
                    },
                });
            r.done(function(data){
                console.log(data);
            }).fail(function(err){
                console.error(err);
            });
        }
    };

    $(document).ready(function () {
        dw_notes.init();
    });

})(jQuery, ajax_data);
