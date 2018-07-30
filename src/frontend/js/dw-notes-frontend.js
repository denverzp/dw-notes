(function (w, $, ajax_data) {

    w.dw_notes = {
        config: {
            parent: '#dw-notes-app',
            list_template: '#notesList',
            list_target: '#notes__column',
            list_parent: '.notes__list',
            list_item: '.notes__item',
            content_target: '#notes__content',
            item_template: '#notesItemContent',
            loading: false,
            // rest data
            url_base: location.protocol + '//' + location.host,
            rest_route: ajax_data && ajax_data.rest_route || '',
            rest_endpoint: ajax_data && ajax_data.rest_endpoint || '',
            user_id: ajax_data && ajax_data.user_id || '',
            username: ajax_data && ajax_data.username || '',
            password: ajax_data && ajax_data.password || '',
            // pages
            first_load: true,
            current_item: null,
            current_page: 1,
            total_notes: null,
            total_pages: null,
            per_page: 10,
            order: 'asc', // asc, desc
            orderby: 'date', // "author", "date", "id","include", "modified", "parent", "relevance", "slug", "include_slugs", "title"
            status: 'any', //"any", "publish", "private", "draft",
            tags: [],
            pads: [],
        },
        auth: function(){

        },
        init: function () {
            var _t = this, _c = _t.config, r;
            _t.initJSRenderHelpers();
            _t.loadListContent();
            // r = _t.RESTRequest('/163', 'post', {'title': 'note title3'});
            // r = _t.RESTRequest('', 'post', {'title': 'new title', content: 'rest created note', author: 1, status: 'publish', type: 'dw_notes'});
            // r = _t.RESTRequest('/163', 'delete', null);

        },
        initJSRenderHelpers: function () {
            $.views.helpers('limitText', function (str, limit) {
                if (typeof limit === 'undefined') {
                    limit = 100;
                }
                var sliced = str.slice(0, limit);
                return sliced + (sliced.length < str.length ? '...' : '')
            });
        },
        bindItem: function () {
        },
        unbindItem: function () {
        },
        bind: function () {
            var _t = this, _c = _t.config;
            $(_c.parent).find(_c.list_parent).on('click', _c.list_item, function (e) {
                e.preventDefault();
                _t.loadItemContent($(this).data('id'));
            });
        },
        unbind: function () {
            var _t = this, _c = _t.config;
            $(_c.parent).find(_c.list_parent).off('click');
        },
        loadItemContent: function (id) {
            var _t = this, _c = _t.config, r;
            if (id === _c.current_item) {
                return;
            }
            _c.current_item = id;
            r = _t.RESTRequest('/' + id, 'get', null);
            r.done(function (data) {
                _c.loading = false;
                var tmpl = $.templates(_c.item_template);
                $(_c.content_target).html(tmpl.render({note: data}));
                _t.bindItem();
            }).fail(function (err) {
                _c.loading = false;
                console.error(err);
            });
        },
        loadListContent: function () {
            var _t = this, _c = _t.config, r;
            _t.unbind();
            r = _t.RESTRequest('', 'get', {
                page: _c.current_page,
                per_page: _c.per_page,
                author: [_c.user_id],
                order: _c.order,
                orderby: _c.orderby,
                status: _c.status,
                tags: _c.tags,
                pads: _c.pads,
            });
            r.done(function (data, status, jqXHR) {
                _c.loading = false;
                var tmpl = $.templates(_c.list_template);
                $(_c.list_target).html(tmpl.render({notes: data, text: ajax_data.text}));
                _t.bind();
                if (_c.first_load) {
                    _c.first_load = !_c.first_load;
                    $(_c.parent).find(_c.list_parent + ' ' + _c.list_item).first().trigger('click');
                }
                //response headers
                _c.total_notes  = parseInt( jqXHR.getResponseHeader('X-WP-Total'));
                _c.total_pages  = parseInt( jqXHR.getResponseHeader('X-WP-TotalPages'));
            }).fail(function (err) {
                _c.loading = false;
                console.error(err);
            });
        },
        RESTRequest: function (url, type, data) {
            var _t = this, _c = _t.config;
            _c.loading = true;
            return $.ajax({
                url: _c.url_base + '/' + _c.rest_route + '/' + _c.rest_endpoint + url,
                type: type,
                dataType: 'json',
                data: data,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(_c.username + ":" + _c.password));
                },
            });
        }
    };

    $(document).ready(function () {
        if (ajax_data.is_auth === '1') {
            if($(w.dw_notes.config.parent).length){
                w.dw_notes.init();
            }
        } else {
            // need auth
            $(w.dw_notes.config.parent).html(ajax_data.auth_form);
        }
    });

})(window, jQuery, ajax_data);
