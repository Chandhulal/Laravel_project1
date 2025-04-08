<x-cover_page_layout>
    @include('components.course_home_layout')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center">
                <span class="me-3" style="padding: 10px;">Available Courses</span>
                <div>
                    <i class="bi bi-house-door"></i>
                </div>
            </div>
            <div class="d-flex align-items-center">
                @if (auth()->user()->hasRole(['super-admin', 'admin']))
                    <span id="add_course" class="btn border btn-outline-primary mx-2">Add Course</span>
                    <span id="import_courses" class="btn border btn-outline-primary mx-2">Import Course</span>
                @endif
                <a href="/export_exel" id="export_exel" class="btn border btn-outline-primary mx-2">Export Course</a>
                {{-- <span id="export_exel" class="btn border btn-outline-primary mx-2">Import Course</span> --}}
                <input class="form-control mx-2" type="text" name="search" id="search" placeholder="Search Name"
                    style="width: 200px">
            </div>
        </div>
    </div>

    <div class="four container">
        <div id="search_res">
            @include('templates.sort_show_table_data')
        </div>
    </div>

    <script>
        //add course----------------------------------------------------------------------------------
        $(document).ready(function() {
            let closest_delete, id_delete, closest_edit, id_edit;

            //add modal=================================================================================
            $(document).on('click', '#add_course', function(event) {
                event.preventDefault();
                $('#add_modal').show();
            });

            //add form request=================================================================================
            $(document).on('submit', '#add_form', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/add_course_data',
                    type: 'POST',
                    data: $('#add_form').serialize(),

                    success: function(response) {
                        if (response) {

                            const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                            let canedit = false;
                            let candelete = false;

                            if (userRole.includes("edit course")) {
                                canedit = true;
                            }
                            if (userRole.includes("delete course")) {
                                candelete = true;
                            }
                            let array = response[0];
                            let status = response[1];
                            $('#body').append(
                                [arrayFunction(array, canedit, candelete, status)]
                            );
                        }
                        close_modal();
                    },

                });
            });

            //edit courses modal=================================================================================
            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                $('#edit_modal').show();
                closest_edit = $(this).closest('tr');
                id_edit = $(this).closest('tr')[0].id;
                $('#edit_name')[0].value = $(this).closest('tr')[0].children[0].innerText;
                $('#edit_id')[0].value = $(this).closest('tr')[0].children[1].innerText;
                $('#edit_semester')[0].value = $(this).closest('tr')[0].children[2].innerText;
                let status = $(this).closest('tr')[0].children[3].children[0].innerText;
                if (status == "Active") {
                    $('#active').prop('checked', true);
                } else {
                    $('#non-active').prop('checked', true);
                }
            });

            //edit request======================================================================================
            $(document).on('submit', '#edit_form', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/edit_course_data/' + id_edit,
                    type: 'PATCH',
                    data: $('#edit_form').serialize(),

                    success: function(response) {
                        if (response) {
                            const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                            let canedit = false;
                            let candelete = false;

                            if (userRole.includes("edit course")) {
                                canedit = true;
                            }
                            if (userRole.includes("delete course")) {
                                candelete = true;
                            }
                            let array = response[0];
                            let status = response[1];

                            $('#body').replaceWith([arrayFunction(array, canedit, candelete,
                                status)]);
                            close_modal();
                        } else {
                            return false;
                        }
                    },
                });
            });

            //delete courses modal=============================================================================
            $(document).on('click', '.delete', function(event) {
                event.preventDefault();
                $('#delete_modal').show();
                closest_delete = $(this).closest('tr');

                id_delete = $(this).closest('tr')[0].id;
                $('#delete_form')[0].children[2].innerText = $(this).closest('tr')[0].childNodes[1]
                    .innerText;
                $('#delete_form')[0].children[4].innerText = $(this).closest('tr')[0].childNodes[3]
                    .innerText;
            });

            //delete courses=============================================================================
            $(document).on('submit', '#delete_form', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/delete_course_data/' + id_delete,
                    type: 'delete',
                    data: $('#delete_form').serialize(),

                    success: function(response) {
                        if (response) {
                            closest_delete.remove();
                            close_modal();

                        } else {
                            return false;
                        }
                    },
                });
            });

            //course ascending order==============================================================================
            $(document).on('click', '.name_ase', function(event) {
                event.preventDefault();

                $('.name_ase').css('visibility', 'hidden');
                $('.name_desc').css('visibility', 'visible');
                $('.id_ase').css('visibility', 'visible');
                $('.id_desc').css('visibility', 'visible');
                $('.semester_ase').css('visibility', 'visible');
                $('.semester_desc').css('visibility', 'visible');

                if ($('#search')[0].value) {
                    fake_url = 'http://127.0.0.1:8000/course_ascending?' + $('#search').serialize();

                    $.ajax({
                        url: fake_url,
                        type: 'get',

                        success: function(response) {
                            if (response) {

                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                let status = response[1];

                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete,
                                            status)]);
                                });
                            } else {
                                return false;
                            }
                        },
                    });

                } else {

                    $.ajax({
                        url: '/course_ascending',
                        type: 'get',
                        data: 'ase',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]);
                                });
                            } else {
                                return false;
                            }
                        },
                    });
                }
            })

            //course descending order======================================================================================
            $(document).on('click', '.name_desc', function(event) {
                event.preventDefault();

                $('.name_ase').css('visibility', 'visible');
                $('.name_desc').css('visibility', 'hidden');
                $('.id_ase').css('visibility', 'visible');
                $('.id_desc').css('visibility', 'visible');
                $('.semester_ase').css('visibility', 'visible');
                $('.semester_desc').css('visibility', 'visible');

                if ($('#search')[0].value) {
                    fake_url = 'http://127.0.0.1:8000/course_descending?' + $('#search').serialize();

                    $.ajax({
                        url: fake_url,
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                let status = response[1];

                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete,
                                            status)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });

                } else {
                    $.ajax({
                        url: '/course_descending',
                        type: 'get',
                        data: 'desc',
                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]);
                                });
                            } else {
                                return false;
                            }
                        },
                    });
                }
            });

            //id ascending order===============================================================================================
            $(document).on('click', '.id_ase', function(event) {
                event.preventDefault();

                $('.name_ase').css('visibility', 'visible');
                $('.name_desc').css('visibility', 'visible');
                $('.id_ase').css('visibility', 'hidden');
                $('.id_desc').css('visibility', 'visible');
                $('.semester_ase').css('visibility', 'visible');
                $('.semester_desc').css('visibility', 'visible');

                if ($('#search')[0].value) {
                    fake_url = 'http://127.0.0.1:8000/id_ascending?' + $('#search').serialize();

                    $.ajax({
                        url: fake_url,
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                let status = response[1];

                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete,
                                            status)]);
                                });
                            } else {
                                return false;
                            }
                        },
                    });

                } else {

                    $.ajax({
                        url: '/id_ascending',
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]);
                                });

                            } else {
                                return false;
                            }
                        },
                    });
                }
            })

            //id descending order======================================================================================================
            $(document).on('click', '.id_desc', function(event) {
                event.preventDefault();

                $('.name_ase').css('visibility', 'visible');
                $('.name_desc').css('visibility', 'visible');
                $('.id_ase').css('visibility', 'visible');
                $('.id_desc').css('visibility', 'hidden');
                $('.semester_ase').css('visibility', 'visible');
                $('.semester_desc').css('visibility', 'visible');

                if ($('#search')[0].value) {
                    fake_url = 'http://127.0.0.1:8000/id_descending?' + $('#search').serialize();

                    $.ajax({
                        url: fake_url,
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                let status = response[1];

                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete,
                                            status)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });

                } else {

                    $.ajax({
                        url: '/id_descending',
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });
                }
            })

            //semester ascending========================================================================
            $(document).on('click', '.semester_ase', function(event) {
                event.preventDefault();

                $('.name_ase').css('visibility', 'visible');
                $('.name_desc').css('visibility', 'visible');
                $('.id_ase').css('visibility', 'visible');
                $('.id_desc').css('visibility', 'visible');
                $('.semester_ase').css('visibility', 'hidden');
                $('.semester_desc').css('visibility', 'visible');

                if ($('#search')[0].value) {
                    fake_url = 'http://127.0.0.1:8000/semester_ascending?' + $('#search').serialize();

                    $.ajax({
                        url: fake_url,
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                let status = response[1];

                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete,
                                            status)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });

                } else {

                    $.ajax({
                        url: '/semester_ascending',
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });
                }
            })

            //semester descending============================================================================
            $(document).on('click', '.semester_desc', function(event) {
                event.preventDefault();

                $('.name_ase').css('visibility', 'visible');
                $('.name_desc').css('visibility', 'visible');
                $('.id_ase').css('visibility', 'visible');
                $('.id_desc').css('visibility', 'visible');
                $('.semester_ase').css('visibility', 'visible');
                $('.semester_desc').css('visibility', 'hidden');

                if ($('#search')[0].value) {
                    fake_url = 'http://127.0.0.1:8000/semester_descending?' + $('#search').serialize();

                    $.ajax({
                        url: fake_url,
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                let status = response[1];

                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete,
                                            status)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });

                } else {

                    $.ajax({
                        url: '/semester_descending',
                        type: 'get',

                        success: function(response) {
                            if (response) {
                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });
                }
            })

            //course paginate============================================================================================
            $(document).on('click', '.page-link ', function(event) {
                event.preventDefault();

                url = $(this)[0].attributes[1];
                if (url == undefined) {
                    return;
                } else {
                    url = $(this)[0].attributes[1].textContent;
                }
                let page = $(this)[0].innerHTML;
                let sample_url = 'http://127.0.0.1:8000/add_course_data' + $(this)[0].search;

                if (url == sample_url) {
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(res) {
                            if (res) {
                                $('#search_res').html(res);
                            } else {
                                return false;
                            }
                        },
                    });
                } else if ($('#search')[0].value) {

                    let search_value = $('#search')[0].value;
                    let fake_url = url + '&search=' + search_value;

                    $.ajax({
                        url: fake_url,
                        type: 'get',
                        // data: ,
                        success: function(res) {
                            if (res) {
                                $('#search_res').html(res);
                            } else {
                                return false;
                            }
                        },
                    });
                } else {

                    $.ajax({
                        url: '?page=' + page,
                        type: 'get',
                        success: function(response) {
                            if (response) {
                                let arr = $('li.page-item').toarray
                                // arr.forEach(link => {
                                // console.log($(link).find('a').attr('href'));
                                // $(link).removeClass('active');
                                // if ($(link).find('a').attr('href') != undefined) {
                                // $(link).addClass('active');
                                // $('.page-item').removeClass('active');
                                // $('a[data-page="' + page + '"]').parent().addClass('active');
                                // }
                                // });
                                // response[0].links.forEach(link => {
                                //     if (url == link.url) {
                                //         console.log(response[0].links);
                                //     }
                                // });

                                // $('#content').empty();
                                // response[0].data.forEach(function (item) {
                                //     $('#content').append('<div>' + item.name + '</div>');
                                // });
                                // var pagination = '';
                                // for (var i = 1; i <= response.last_page; i++) {
                                //     pagination += '<li class="page-item' + (i === response.current_page ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                                // }
                                // $('.pagination').html(pagination);

                                const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                                let canedit = false;
                                let candelete = false;

                                if (userRole.includes("edit course")) {
                                    canedit = true;
                                }
                                if (userRole.includes("delete course")) {
                                    candelete = true;
                                }
                                $('#body').empty();
                                response[0].data.forEach(array => {
                                    $('#body').append(
                                        [arrayFunction(array, canedit, candelete)]
                                    );
                                });
                            } else {
                                return false;
                            }
                        },
                    });
                }
            });

            //search course===========================================================================================
            $(document).on('input', '#search', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '/search_data',
                    type: 'get',
                    data: $('#search').serialize(),

                    success: function(response) {
                        if (response && response[0].length !== 0) {

                            const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                            let canedit = false;
                            let candelete = false;

                            if (userRole.includes("edit course")) {
                                canedit = true;
                            }
                            if (userRole.includes("delete course")) {
                                candelete = true;
                            }
                            let status = response[1];

                            $('#body').empty();
                            response[0].forEach(array => {
                                $('#body').append(
                                    [arrayFunction(array, canedit, candelete,
                                        status)]
                                );
                            });
                        } else {
                            $('#body').empty();
                            $('#body').append([
                                `<tr> 
                                    <td colspan="5">No Data</td>
                                </tr>`
                            ]);
                        }
                    }
                });
            });

            //support mail=================================================================================
            $(document).on('submit', '#support_form', function(event) {
                event.preventDefault();
                const user_id = @json(auth()->user()->id);
                $.ajax({
                    url: '/support_form_submit/' + user_id,
                    type: 'POST',
                    data: $('#support_form').serialize(),

                    success: function(response) {
                        if (response) {
                            confirm('Confirm');
                            close_modal();
                        } else {
                            return false;
                        }
                    },

                });
            });

            //export excel
            $(document).on('click', '#export_exel', function(e) {
                if (!confirm('Confirm Export')) {
                    e.preventDefault();
                }
            });

            //export excel data =================================================================================
            // $(document).on('click', '#export_exel', function(event) {
            //     event.preventDefault();

            //     $.ajax({
            //         url: '/export_exel',
            //         type: 'get',

            //         success: function(response) {
            //             if (response) {
            //                 console.log(response);

            //             } else {
            //                 return false;
            //             }
            //         },

            //     });
            // });

            //import excel data =================================================================================
            $(document).on('submit', '#import_data', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: '/import_exel',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response) {
                            
                            console.log(response);
                            const userRole = @json(auth()->user()->getAllPermissions()->pluck('name'));
                            let canedit = false;
                            let candelete = false;

                            if (userRole.includes("edit course")) {
                                canedit = true;
                            }
                            if (userRole.includes("delete course")) {
                                candelete = true;
                            }
                            $('#body').empty();
                            response[0].forEach(array => {
                                
                                $('#body').append([
                                    arrayFunction(array, canedit, candelete)
                                ]);
                            });
                            close_modal();
                        } else {
                            return false;
                        }
                    },

                });
            });

            //array function================================================================
            function arrayFunction(array, canedit, candelete, status) {

                return `<tr id=` + array.id + `>
                            <td class="table_name_sort">
                                <a href="https://www.youtube.com/results?search_query=` + array.name +
                    `" target="_blank">` + array.name + `</a>
                            </td>
                            <td>` + array.course_id + `</td>
                            <td>` + array.semester + `</td>                                   
                            ${array.status_id == 1 ?                             
                                `<td style="color: green;">
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <span class="glyphicon glyphicon-ok green-circle mx-2"></span>
                                                                        active
                                                                    </div>
                                                                </td>` : `<td style="color: red;">
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <span class="glyphicon glyphicon-remove red-circle mx-2"></span>
                                                                        inactive
                                                                    </div>
                                                                </td>`}           
                            ${canedit || candelete ? '<td>':''}
                                <div class="d-flex align-items-center justify-content-center">
                                    ${canedit ? '<button class="edit btn btn-warning mx-1" style="width:100%">Edit</button>' : ''}
                                    ${candelete ? '<button class="delete btn btn-danger mx-1" style="width:100%">Delete</button>' : ''}
                                </div>
                            ${canedit || candelete ? '</td>':''} 
                        </tr>`
            }

            //close function
            function close_modal() {
                $('#add_form').find('.info').val("");
                $('#add_modal').hide();
                $('#edit_form').find('.info').val("");
                $('#delete_modal').hide();
                $('#delete_form').find('.info').val("");
                $('#edit_modal').hide();
                $('#profile_modal').hide();
                $('#settings_modal').hide();
                $('#import_modal').hide();
                $('#support_form').find('.info').val("");
                $('#support_modal').hide();
            };
        });
    </script>
</x-cover_page_layout>
