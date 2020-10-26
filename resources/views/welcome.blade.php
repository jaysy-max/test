<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form id="form1" method="POST" action="/" class="my-4 col-md-10 mx-auto">
                @csrf
                <div class="row">
                    <div class="col-sm-8 form-group">
                        <input type="text" name="question" class="form-control" placeholder="Question">
                    </div>
                    <div class="col-sm-4 px-0 form-group">
                        <select id="type" name="type" class="form-control">
                            <option value="1">Multiple Choice</option>
                            <option value="2">Checkboxes</option>
                            <option value="3">Short Answer</option>
                            <option value="4">Paragraph</option>
                            <option value="5">File Upload</option>
                        </select>
                    </div>
                </div>

                <div id="options"></div>

                <button type="button" id="btnAddOption" class="btn btn-link btn-light">Add Option</button>

            </form>

            <form id="form2" method="POST" action="/" class="my-4 col-md-10 mx-auto">
                @csrf
                <div class="row">
                    <div class="col-sm-8 form-group">
                        <input type="text" name="question" class="form-control" placeholder="Question">
                    </div>
                    <div class="col-sm-4 px-0 form-group">
                        <select id="type" name="type" class="form-control">
                            <option value="1">Multiple Choice</option>
                            <option value="2">Checkboxes</option>
                            <option value="3">Short Answer</option>
                            <option value="4">Paragraph</option>
                            <option value="5">File Upload</option>
                        </select>
                    </div>
                </div>

                <div id="options"></div>

                <button type="button" id="btnAddOption" class="btn btn-link btn-light">Add Option</button>

            </form>

            <button type="button" id="btnSave">Save</button>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {

                var options = $("#options");
                var type = $("#type");
                var btnAddOption = $("#btnAddOption");
                var btnSave = $("#btnSave");

                getType(type);

                type.change(function() {
                    btnAddOption.removeAttr("disabled");
                    btnAddOption.css("display", "block");

                    if(options.find("textarea")) {
                        options.find("textarea").parent().remove();
                        options.find("textarea").remove();
                        console.log("has textarea");
                    }

                    if(type.val() == 1) {
                        options.each(function() {
                            $(this).find("input").each(function() {
                                $(this).attr("type", "radio");
                                $(this).attr("class", "form-check-input position-static");
                                $(this).parent().attr("class", "form-check");
                            });
                        });
                    } else if(type.val() == 2) {
                        options.each(function() {
                            $(this).find("input").each(function() {
                                $(this).attr("type", "checkbox");
                            });
                        });
                    } else {
                        options.each(function() {
                            $(this).children().each(function() {
                                $(this).remove();
                            });
                        });
                        getType(type);
                        btnAddOption.prop("disabled", "true");
                        btnAddOption.css("display", "none");
                    }

                });

                btnAddOption.click(function() {
                    getType(type);
                });

                btnSave.click(function() {
                    var arr = ["#form1", "#form2"];
                    arr.forEach(myFunc);
                    
                });

                function getType(type) {

                    var input = $("<input></input>");
                    var div = $("<div></div>");

                    if(type.val() == 1) {
                        input.attr("type", "radio");
                        input.attr("class", "form-check-input position-static");
                        div.addClass("form-check");
                        div.append(input);
                    }

                    if(type.val() == 2) {
                        input.attr("type", "checkbox");
                        input.attr("class", "form-check-input position-static");
                        div.addClass("form-check");
                        div.append(input);
                    }

                    if(type.val() == 3) {
                        input.attr("type", "text");
                        input.attr("class", "form-control");
                        div.append(input);
                    }

                    if(type.val() == 4) {
                        var textarea = $("<textarea></textarea>");
                        textarea.attr("class", "form-control");
                        textarea.attr("placeholder", "Long answer text");
                        textarea.attr("rows", 5);
                        div.append(textarea);
                    }

                    if(type.val() == 5) {
                        input.attr("type", "file");
                        div.append(input);
                    }

                    options.append(div);

                }

            });
        </script>
    </body>
</html>
