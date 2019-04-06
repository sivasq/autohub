(function ($) {
    var i = 1;
    let EditableTable = {

        options: {
            addButton: '#updateTable',
            table: tableName,
            dialog: {
                wrapper: '#dialog',
                cancelButton: '#dialogCancel',
                confirmButton: '#dialogConfirm',
            }
        },

        initialize: function () {
            this
                .setVars()
                .build()
                .events();
        },

        setVars: function () {
            this.$table = $(this.options.table);
            this.$addButton = $(this.options.addButton);

            // dialog
            this.dialog = {};
            this.dialog.$wrapper = $(this.options.dialog.wrapper);
            this.dialog.$cancel = $(this.options.dialog.cancelButton);
            this.dialog.$confirm = $(this.options.dialog.confirmButton);

            return this;
        },

        build: function () {
            this.datatable = this.$table.DataTable({
                ajax: {
                    'url': baseUrl + '/getdata',
                    'type': 'GET',
                    'beforeSend': function (request) {
                        request.setRequestHeader(headerKey, headerValue);
                    }
                },
                aoColumns: dataColumns,
                rowGroup: rowGroup,
                order: orderBy
            });

            window.dt = this.datatable;

            return this;
        },

        events: function () {
            var _self = this;

            this.$table
                .on('click', 'a.save-row', function (e) {
                    e.preventDefault();

                    _self.rowSave($(this).closest('tr'));
                })
                .on('click', 'a.cancel-row', function (e) {
                    e.preventDefault();

                    _self.rowCancel($(this).closest('tr'));
                })
                .on('click', 'a.edit-row', function (e) {
                    e.preventDefault();

                    _self.rowEdit($(this).closest('tr'));
                })
                .on('click', 'a.remove-row', function (e) {
                    e.preventDefault();

                    var $row = $(this).closest('tr');

                    $.magnificPopup.open({
                        items: {
                            src: _self.options.dialog.wrapper,
                            type: 'inline'
                        },
                        preloader: false,
                        modal: true,
                        callbacks: {
                            change: function () {
                                _self.dialog.$confirm.on('click', function (e) {
                                    e.preventDefault();

                                    _self.rowRemove($row);
                                    $.magnificPopup.close();
                                });
                            },
                            close: function () {
                                _self.dialog.$confirm.off('click');
                            }
                        }
                    });
                });

            this.$addButton.on('click', function (e) {
                e.preventDefault();

                _self.rowAdd();
            });

            this.dialog.$cancel.on('click', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });

            return this;
        },

        // ==========================================================================================
        // ROW FUNCTIONS
        // ==========================================================================================
        rowAdd: function () {
            console.log(JSON.stringify(valueArray));
            $.ajax({
                url: updateUrl + '/update',
                data: JSON.stringify(valueArray),
                method: "PUT",
                beforeSend: function (request) {
                    request.setRequestHeader(headerKey, headerValue);
                }
            }).success(function (response) {
                if(response.status){
                    swal("Success", "The Item Prices are Updated Successfully", "success");
                    $("#updateTable").removeAttr("disabled", "disabled");
                }else{
                    if(!response.status){
                        swal("Failed", "You Can't Update the Price", "error");
                        $("#updateTable").removeAttr("disabled", "disabled");
                    }
                }
            }).fail(function () {
                swal("Failed", "Fail to Update the price of the order", "error");
                $("#updateTable").removeAttr("disabled", "disabled");
            });
        },

        rowCancel: function ($row) {
            var _self = this,
                $actions,
                i,
                data;

            if ($row.hasClass('adding')) {
                this.rowRemove($row);
            } else {

                data = this.datatable.row($row.get(0)).data();
                this.datatable.row($row.get(0)).data(data);

                $actions = $row.find('td.actions');
                if ($actions.get(0)) {
                    this.rowSetActionsDefault($row);
                }

                this.datatable.draw();
            }
        },

        rowEdit: function ($row) {            
            var _self = this,
                data;
            data = this.datatable.row($row.get(0)).data();
            for (var dataField in data) {
                var els = document.getElementsByName(dataField);
                for (var i = 0; i < els.length; i++) {
                    els[i].value = data[dataField]
                }
            }
            document.getElementById("save-button").innerHTML = "Update";
            var submitType = document.getElementById("save-button");
            submitType.value = "Update";
        },

        rowSave: function ($row) {
            var _self = this,
                $actions,
                values = [];

            if ($row.hasClass('adding')) {
                this.$addButton.removeAttr('disabled');
                $row.removeClass('adding');
            }

            values = $row.find('td').map(function () {
                var $this = $(this);

                if ($this.hasClass('actions')) {
                    _self.rowSetActionsDefault($row);
                    return _self.datatable.cell(this).data();
                } else {
                    return $.trim($this.find('input').val());
                }
            });

            this.datatable.row($row.get(0)).data(values);

            $actions = $row.find('td.actions');
            if ($actions.get(0)) {
                this.rowSetActionsDefault($row);
            }

            this.datatable.draw();
        },

        rowRemove: function ($row) {
            var _self = this,
                data
            that = this;
            if ($row.hasClass('adding')) {
                this.$addButton.removeAttr('disabled');
            }
            data = this.datatable.row($row.get(0)).data();
            $.post(baseUrl + '/delete', {
                id: data[data_id]
            }).success(function () {
                swal("Success", "The Record with ID : " + data[data_id] + " has been successfully deleted", "success");
                that.datatable.row($row.get(0)).remove().draw();
            }).fail(function () {
                swal("Failed", "Fail to delete the record", "error");
            });
        },

        rowSetActionsEditing: function ($row) {
            $row.find('.on-editing').removeClass('hidden');
            $row.find('.on-default').addClass('hidden');
        },

        rowSetActionsDefault: function ($row) {
            $row.find('.on-editing').addClass('hidden');
            $row.find('.on-default').removeClass('hidden');
        }

    };

    $(function () {
        EditableTable.initialize();
    });

}).apply(this, [jQuery]);