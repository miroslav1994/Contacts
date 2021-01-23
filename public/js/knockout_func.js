$( document ).ready(function() {
    var initialData = [
        { firstName: "", lastName: "", phones: [
        { type: "", number: "" },
        { type: "", number: ""}]
        }
    ];

    var ContactsModel = function(contacts) {
        var self = this;
        self.contacts = ko.observableArray(ko.utils.arrayMap(contacts, function(contact) {
            return { firstName: contact.firstName, lastName: contact.lastName, phones: ko.observableArray(contact.phones) };
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
                    url: '/administration/postajaxContacts',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, contacts:JSON.stringify(ko.toJS(self.contacts)),  message:$(".getinfo").val()},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        window.location.href = "/contacts";
                    },
                    complete: function (data) {
                        window.location.href = "/administration/contacts";
                    },
                });
        };
        self.lastSavedJson = ko.observable("")
    };
    ko.applyBindings(new ContactsModel(initialData));
});

