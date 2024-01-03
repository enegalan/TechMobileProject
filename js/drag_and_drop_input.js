/**
 * Drag and Drop File Uploading
 * Based on [Drag and Drop File Uploading]{@link https://css-tricks.com/drag-and-drop-file-uploading} by [Osvaldas Valutis]{@link http://osvaldas.info}
 * @namespace fileUpload
 */
var fileUpload = (function ($, window, document, undefined) {
    /**
     * Defaults
     */

    /**
     * Init
     */

    /**
     * Config
     */
})(jQuery, window, document);

/// ------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------

(function ($, window, document, undefined) {
    // feature detection for drag&drop upload

    var isAdvancedUpload = (function () {
        var div = document.createElement("div");
        return (
            ("draggable" in div || ("ondragstart" in div && "ondrop" in div)) &&
            "FormData" in window &&
            "FileReader" in window
        );
    })();

    // applying the effect for every form

    $(".box").each(function () {
        var $form = $(this),
            $input = $form.find('input[type="file"]'),
            $label = $form.find("label"),
            $errorMsg = $form.find(".box__error span"),
            $restart = $form.find(".box__restart"),
            droppedFiles = false,
            showFiles = function (files) {
                $label.text(
                    files.length > 1
                        ? ($input.attr("data-multiple-caption") || "")
                            .replace("{count}", files.length)
                        : files[0].name
                );
            };

        // letting the server side to know we are going to make an Ajax request
        $form.append('<input type="hidden" name="ajax" value="1" />');

        // automatically submit the form on file select
        $input.on("change", function (e) {
            showFiles(e.target.files);

            $form.trigger("submit");
        });

        // drag&drop files if the feature is available
        if (isAdvancedUpload) {
            $form
                .addClass("has-advanced-upload") // letting the CSS part to know drag&drop is supported by the browser
                .on("drag dragstart dragend dragover dragenter dragleave drop", function (
                    e
                ) {
                    // preventing the unwanted behaviours
                    e.preventDefault();
                    e.stopPropagation();
                })
                .on("dragover dragenter", function () //
                {
                    $form.addClass("is-dragover");
                })
                .on("dragleave dragend drop", function () {
                    $form.removeClass("is-dragover");
                })
                .on("drop", function (e) {
                    droppedFiles = e.originalEvent.dataTransfer.files; // the files that were dropped
                    showFiles(droppedFiles);

                    $form.trigger("submit"); // automatically submit the form on file drop
                });
        }

        // if the form was submitted

        $form.on("submit", function (e) {

            if (isAdvancedUpload) {
                // ajax file upload for modern browsers
                e.preventDefault();

                // gathering the form data
                var ajaxData = new FormData($form.get(0));
                if (droppedFiles) {
                    $.each(droppedFiles, function (i, file) {
                        ajaxData.append($input.attr("name"), file);
                    });
                }

                var formDataObject = {};
                ajaxData.forEach(function (value, key) {
                    formDataObject[key] = value;
                });

                //Send this data to main FormData
            }
        });

        // restart the form if has a state of error/success

        $restart.on("click", function (e) {
            e.preventDefault();
            $form.removeClass("is-error is-success");
            $input.trigger("click");
        });

        // Firefox focus bug fix for file input
        $input
            .on("focus", function () {
                $input.addClass("has-focus");
            })
            .on("blur", function () {
                $input.removeClass("has-focus");
            });
    });
})(jQuery, window, document);
