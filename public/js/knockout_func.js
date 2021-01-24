$( document ).ready(function() {

    var is_edit = $("#is_edit_id").val();
    var url = "";;
    if(is_edit == '1') {
        url = '/administration/postAjaxContactsUpdate';
        var types_phones = $("#type_phone").val();
        var phones_number = $("#phone_number").val();
        var phones_id = $("#phone_id").val();
        var types_phones_arr = [];
        var phones_number_arr = [];
        var phones_id_arr = [];

        types_phones_arr = types_phones.split(',');
        phones_number_arr = phones_number.split(',');
        phones_id_arr = phones_id.split(',');

        var phones = [];
        for(var i = 0; i<types_phones_arr.length; i++) {
           phones[i] = {};
           phones[i].type = types_phones_arr[i];
           phones[i].number = phones_number_arr[i];
           phones[i].phones_id = phones_id_arr[i];
        }

        var initialData = [
                { contact_id: $("#contact_id_edit").val(), firstName: $("#firstName_contact").val(), lastName: $("#lastName_contact").val(), phones }
            ];

        } else {
            url = '/administration/postAjaxContactsStore';
            var initialData = [
                { firstName: "", lastName: "", phones: [
                        { type: "", number: "" }]
                }
            ];
        }

    var ContactsModel = function(contacts) {
        var self = this;
        self.contacts = ko.observableArray(ko.utils.arrayMap(contacts, function(contact) {
            return { contact_id: contact.contact_id, firstName: contact.firstName, lastName: contact.lastName, phones: ko.observableArray(contact.phones) };
        }));

        self.addContact = function() {
            self.contacts.push({
                firstName: "",
                lastName: "",
                phones: ko.observableArray()
            });
        };

        self.removeContact = function(contact) {
            self.contacts.remove(contact);
        };

        self.addPhone = function(contact) {
            contact.phones.push({
                type: "",
                number: ""
            });
        };

        self.removePhone = function(phone) {
            $.each(self.contacts(), function() { this.phones.remove(phone) })
        };

        self.save = function() {
                self.lastSavedJson(JSON.stringify(ko.toJS(self.contacts), null, 2));
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, contacts:JSON.stringify(ko.toJS(self.contacts)),  message:$(".getinfo").val()},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if(data.success != false) {
                            $("#mess_danger").hide();
                            $("#mess_danger").html();
                            $("#is_error").val("0");
                            window.location.href = "/administration/contacts";
                        }  else {
                            $("#mess_danger").show();
                            $("#mess_danger").html(data.data);
                            $("#is_error").val("1");
                        }
                    },
                    error: function (data) {
                       if(data.responseText == "") {
                           $("#mess_danger").hide();
                           $("#mess_danger").html();
                           $("#is_error").val("0");
                       }
                    },
                    complete: function (data) {
                        if ($('#is_error').val() == "0"){
                            window.location.href = "/administration/contacts";
                        }
                    },
                });
        };
        self.lastSavedJson = ko.observable("")
    };
    console.log(initialData);
    ko.applyBindings(new ContactsModel(initialData));
});

