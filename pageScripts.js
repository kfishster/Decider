function FBLogin() {

    /* FACEBOOK LOGIN API START */

    // Additional JS functions here
    window.fbAsyncInit = function () {
        FB.init({
            appId: '153783808115722', // App ID
            channelUrl: '//https://decider.azurewebsites.net//channel.html', // Channel File
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true // parse XFBML
        });

        // Additional init code here

    };

    // Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk',
            ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));

    function login() {
        FB.login(function (response) {
            if (response.authResponse) {

                var ID = 0;
                FB.api('/me', function (response) {
                    ID = response.id;
                    email = response.email;
                    name = response.name;

                    //If login successful, register user and set cookie via signin php endpoint, then redirect to userPage
                    $.post('./scripts/signin.php', {
                        id: ID,
                        email: email,
                        name: name
                    }, function (response) {
                        window.location = 'userPage.php';
                    });


                }, {
                    perms: 'email'
                });

            } else {
                // cancelled TODO show error
            }
        }, {
            scope: 'email'
        });
    }

    /* FACEBOOK LOGIN API END */

    //Attaches click functionality to login through fb button
    $(document).ready(function () {
        $('#loginFB').click(function () {
            login();
        });
    });
}


function userPageScripts() {

    function changeState(todo, num) {

        down = $('.down[path="' + todo + '"]').attr('state') == '1';
        up = $('.up[path="' + todo + '"]').attr('state') == '1';

        console.log(down + " " + up + " " + num);

        if (down) {
            if (num == 1) {
                $('.down[path="' + todo + '"]').css('background-color', '');
                $('.down[path="' + todo + '"]').attr('state', '');
            }
        } else if (up) {
            if (num == -1) {
                $('.up[path="' + todo + '"]').css('background-color', '');
                $('.up[path="' + todo + '"]').attr('state', '');
            }
        } else {
            if (num == 1) {
                $('.up[path="' + todo + '"]').css('background-color', '#00aa00');
                $('.up[path="' + todo + '"]').attr('state', '1');
            }
            if (num == -1) {
                $('.down[path="' + todo + '"]').css('background-color', '#aa0000');
                $('.down[path="' + todo + '"]').attr('state', '1');
            }
        }

    }

    //When document loads, attaches a modal to the newEvent button
    $(document).ready(function(){
        
        $('#newEvent').click(function () {

            $('#createEventModal').modal('show');
        });



/*Asynchronously loads the event information using an PHP endpoint
Event page is thrown an eventID through POST and generates a page
with all the event information. Page is loaded and faden in gracefully.*/
        $('.openEvent').click(function () {

            id = $(this).attr('eventID');
            $('#eventContent').fadeOut("slow", function () {

                $(this).load('eventPage.php', {
                    id: id,
                    userID: $('#getUserID').attr('userID')
                }, function () {

                    $(this).fadeIn();

                    $('.up').click(function () {

                        newNum = parseInt($('#' + $(this).attr('path') + 'num').text());
                        obj = $('#' + $(this).attr('path') + 'num');
                        path = $(this).attr('path');


                        $.post('scripts/addPoint.php', {
                            todo: path,
                            userID: $('#getUserID').attr('userID'),
                            point: '1'
                        }, function (data) {

                            dataArr = data.split('\n');
                            newNum += parseInt(dataArr[0]);
                            obj.text(newNum);
                            changeState(path, parseInt(dataArr[0]));

                        });


                    });

                    $('.down').click(function () {

                        newNum = parseInt($('#' + $(this).attr('path') + 'num').text());
                        obj = $('#' + $(this).attr('path') + 'num');
                        path = $(this).attr('path');

                        $.post('scripts/addPoint.php', {
                            todo: $(this).attr('path'),
                            userID: $('#getUserID').attr('userID'),
                            point: '-1'
                        }, function (data) {

                            dataArr = data.split('\n');
                            newNum += parseInt(dataArr[0]);
                            obj.text(newNum);
                            changeState(path, parseInt(dataArr[0]));


                        });
                    });

                    $('#newIdea').click(function () {

                        $('#submitTodo').attr('eventID', id);
                        $('#createTodoModal').modal('show');


                    });



                });
            });
        });

        /*
When event is created, send event information to addEvent.php which adds the event
to the database. Once it is done, addEvent returns the eventID that was generated
for this new event. The new event link is added to the sidebar upon completion.
  */
        $('#submitEvent').submit(function (event) {
            event.preventDefault();
            var $form = $(this);


            title = $('#titleinp').val();
            id = $('#getUserID').attr('userID');


            $.post('./scripts/addEvent.php', {
                title: title,
                userID: id
            }, function (data) {



                $('#eventList').append('<li><a class="openEvent" eventID="' + data + '">' + title + '</a></li>');


                $('#titleinp').val('').blur();

                $('.openEvent').click(function () {

                    id = $(this).attr('eventID');
                    $('#eventContent').fadeOut("slow", function () {

                        $(this).load('eventPage.php', {
                            id: id,
                            userID: $('#getUserID').attr('userID')
                        }, function () {

                            $(this).fadeIn();

                            $('.up').click(function () {

                                newNum = parseInt($('#' + $(this).attr('path') + 'num').text());
                                obj = $('#' + $(this).attr('path') + 'num');
                                path = $(this).attr('path');


                                $.post('scripts/addPoint.php', {
                                    todo: path,
                                    userID: $('#getUserID').attr('userID'),
                                    point: '1'
                                }, function (data) {

                                    dataArr = data.split('\n');
                                    newNum += parseInt(dataArr[0]);
                                    obj.text(newNum);
                                    changeState(path, parseInt(dataArr[0]));

                                });


                            });
                            $('.down').click(function () {

                                newNum = parseInt($('#' + $(this).attr('path') + 'num').text());
                                obj = $('#' + $(this).attr('path') + 'num');
                                path = $(this).attr('path');

                                $.post('scripts/addPoint.php', {
                                    todo: $(this).attr('path'),
                                    userID: $('#getUserID').attr('userID'),
                                    point: '-1'
                                }, function (data) {

                                    dataArr = data.split('\n');
                                    newNum += parseInt(dataArr[0]);
                                    obj.text(newNum);
                                    changeState(path, parseInt(dataArr[0]));


                                });

                            });

                        });

                    });

                });

                $('#eventContent').fadeOut("slow", function () {


                    $(this).load('eventPage.php', {
                        id: data,
                        userID: $('#getUserID').attr('userID')
                    }, function () {

                        $('#createEventModal').modal('hide');
                        $(this).fadeIn();
                    });

                });

                $('.accordion-toggle').click(function () {

                    var href = $(this).attr('href');
                    var tdid = $(this).attr('tdid');
                    $('cd' + href).load('scripts/commentPage.php?tdid=' + tdid);

                });

            });

        });

        $('#todoSubmitConf').focusin(function () {

            $(this).attr('loc', '0');

        });

        /*
When todo has been created, send addTodo all the necessary information via POST
and upon completetion, reload the event page.
*/
        $('#submitTodo').submit(function (event) {
            event.preventDefault();
            var $form = $(this);

            title = $('#titletodo').val(),
            descr = $('#descr').val();
            evID = $(this).attr('eventID');
            loc = $('#location').val();

            
            $('#location').blur();
            
alert($('#location').val());
            if ($('#todoSubmitConf').attr('loc') == '0') {

                $.getJSON('http://maps.googleapis.com/maps/api/geocode/json', {
                    address: loc,
                    sensor: 'false'
                }, function (data) {

                    $('#location').val(data.results[0].formatted_address);
                    $('#location').attr('stAddr', data.results[0].address_components[0].long_name + ' ' + data.results[0].address_components[1].short_name);
                    $('#location').attr('city', data.results[0].address_components[2].long_name);
                    $('#location').attr('state', data.results[0].address_components[5].short_name);
                    $('#location').attr('lat', data.results[0].geometry.location.lat);
                    $('#location').attr('lon', data.results[0].geometry.location.lng);
                    $('#todoSubmitConf').attr('loc', '1');
                    $('#confirmation').slideDown();
                });


            } else {
                $.post('./scripts/addTodo.php', {
                    title: title,
                    descr: descr,
                    id: evID
                }, function () {


                    $('#createTodoModal').modal('hide');
                    $('#titletodo').val('').blur();
                    $('#descr').val('').blur();
                    $('#confirmation').slideUp();



                    $('#eventContent').fadeOut("slow", function () {

                        $(this).load('eventPage.php', {
                            id: evID,
                            userID: $('#getUserID').attr('userID')
                        }, function () {

                            $('#newIdea').click(function () {

                                $('#submitTodo').attr('eventID', id);
                                $('#createTodoModal').modal('show');


                            });

                            $('.up').click(function () {

                                newNum = parseInt($('#' + $(this).attr('path') + 'num').text());
                                obj = $('#' + $(this).attr('path') + 'num');
                                path = $(this).attr('path');


                                $.post('scripts/addPoint.php', {
                                    todo: path,
                                    userID: $('#getUserID').attr('userID'),
                                    point: '1'
                                }, function (data) {

                                    dataArr = data.split('\n');
                                    newNum += parseInt(dataArr[0]);
                                    obj.text(newNum);
                                    changeState(path, parseInt(dataArr[0]));

                                });


                            });

                            $('.down').click(function () {

                                newNum = parseInt($('#' + $(this).attr('path') + 'num').text());
                                obj = $('#' + $(this).attr('path') + 'num');
                                path = $(this).attr('path');

                                $.post('scripts/addPoint.php', {
                                    todo: $(this).attr('path'),
                                    userID: $('#getUserID').attr('userID'),
                                    point: '-1'
                                }, function (data) {

                                    dataArr = data.split('\n');
                                    newNum += parseInt(dataArr[0]);
                                    obj.text(newNum);
                                    changeState(path, parseInt(dataArr[0]));


                                });
                            });

                            $(this).fadeIn();
                        });

                    });

                });
            }
        });

});
}

    