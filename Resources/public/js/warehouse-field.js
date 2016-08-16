'use strict';
/**
 * Textarea field
 *
 * @author    Julien Sanchez <julien@akeneo.com>
 * @author    Filips Alpe <filips@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
define(
    [
        'pim/field',
        'underscore',
        'jquery',
        'text!lavoweb/template/product/field/warehouse',
        'jquery.select2'
    ],
    function (
        Field,
        _,
        $,
        fieldTemplate
    ) {
        return Field.extend({
            fieldTemplate: _.template(fieldTemplate),
            events: {
                'change .field-input:first .lavoweb-warehouse-data': 'updateModel'
            },
            renderInput: function (context) {
                return this.fieldTemplate(context);
            },
            postRender: function() {
                var $fieldInput = this.$('.field-input:first'),
                    $tbody = $fieldInput.find('tbody'),
                    $prototype = $fieldInput.find('tfoot tr'),
                    data = $fieldInput.find('.lavoweb-warehouse-data').val(),
                    choices = null,
                    self = this;

                $.each(data.split("\n"), function() {
                    var $trow = $prototype.clone(),
                        $fields = $trow.find('.lavoweb-warehouse-field');

                    $.each(this.split("\t"), function(index, value) {
                        if (index === 0) {
                            $fields.eq(0).attr("data-value", value);
                        } else {
                            $fields.eq(index).val(value);
                        }
                    });
                    $tbody.append($trow);
                });
                $fieldInput.find(".lavoweb-warehouse-add").click(function() {
                    if (null === choices) {
                        return;
                    }
                    var $newRow = $prototype.clone();
                    $tbody.append($newRow);
                    $newRow.find(".lavoweb-warehouse-name").select2({
                        data: choices,
                        placeholder: "Please make a choice"
                    })
                    self.updateHiddenField();
                })
                $tbody
                    .on("change", ".lavoweb-warehouse-field", this.updateHiddenField.bind(this))
                    .on('click', 'button', function(){
                        $(this).closest("tr").remove();
                        self.updateHiddenField();

                        return false;
                    })
                    .sortable({
                        axis: "y",
                        cursor: "move",
                        /**containment: "#" + this.widgetId,**/
                        handle: ".icon-reorder",
                        update: this.updateHiddenField.bind(this),
                        start: function(e, ui ){
                            ui.placeholder.height(ui.helper.outerHeight());
                        },
                        tolerance: "pointer",
                        helper: function(e, tr) {
                            var originals = tr.children(),
                                helper = tr.clone();
                            helper.children().each(function(index) {
                                $(this).width(originals.eq(index).outerWidth());
                            });
                            return helper;
                        },
                        forcePlaceholderSize: true
                    })
                $.get(
                    this.getChoiceUrl(),
                    function (response) {
                        choices = response.results
                        $tbody.find(".lavoweb-warehouse-name")
                            .select2({
                                data: choices,
                            }).each(function() {
                                $(this)
                                    .select2("val", this.getAttribute("data-value"))
                                    .select2("readonly", !self.isEditable())
                            })
                    });
            },
            updateHiddenField: function() {
                var value = [];
                this.$('.field-input:first .lavoweb-warehouse-values tbody tr').each(function() {
                    var $row = $(this);
                    var row = [
                        $row.find(".lavoweb-warehouse-name").select2("val"),
                        $row.find(".lavoweb-warehouse-percentage").val()
                    ];
                    value.push(row.join("\t"));
                });
                this.$('.field-input:first .lavoweb-warehouse-data')
                    .val(value.join("\n"))
                    .trigger("change");
            },
            updateModel: function () {
                var data = this.$('.field-input:first .lavoweb-warehouse-data').val();
                data = '' === data ? this.attribute.empty_value : data;

                this.setCurrentValue(data);
            },
            getChoiceUrl: function () {
                return Routing.generate(
                    'pim_ui_ajaxentity_list',
                    {
                        'class': 'PimCatalogBundle:AttributeOption',
                        'dataLocale': this.context.locale,
                        'collectionId': this.attribute.id,
                        'options': {'type': 'code'}
                    }
                )
            },
            setFocus: function () {
                this.$('.field-input:first textarea').focus();
            }
        });
    }
);
