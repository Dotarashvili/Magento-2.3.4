define([
    'uiComponent',
    'ko',
    'jquery'
], function (Component, ko, $) {
    return Component.extend({
        initialize: function (config) {
            this._super();
            var self = this;
            this._country(config.ourCountry);
            this._street(config.ourStreet);
            this._number(config.ourStreetNum);
            this._size(config.ourSize);
            $('#companies').click(function(){
                var val = $(this).val();
                getDetails(val);
            });

            function getDetails(id){
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "http://example.com/rest/V1/devall_davidotarashvili/"+ id,
                        success: function(data){
                            setCompanyDetails(data);
                        }
                    });
            }

            function setCompanyDetails(data) {
                self._country(data.country);
                self._street(data.street);
                self._number(data.street_num);
                self._size(data.size);
            }

        },

        _country : ko.observable(''),
        _street : ko.observable(''),
        _number : ko.observable(''),
        _size : ko.observable('')
    });
});
