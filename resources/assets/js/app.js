import $ from 'jquery'
import 'select2'
import 'bootstrap'
import './bootstrap'

$(document).ready(function () {
    window.project = document.getElementById('app').dataset.project

    const images = document.querySelector('.images-gallery')
    if (images) {
        window.gallery = new window.Viewer(images, {
          url (image) {
            return image.src.replace('-medium', '-original')
          },
        })
    }

    $('#select_categories').click(function (e) {
        $('#categories').find('option').prop('selected', 'selected')
        $('#categories').trigger('change')
        e.preventDefault()
    })
    $('#clear_categories').click(function (e) {
        $('#categories').find('option').prop('selected', false)
        $('#categories').trigger('change')
        e.preventDefault()
    })

    $('.select2').select2()
    $('.select2-tags').select2({ tags: true })
    $('#flash-overlay-modal').modal()
    $('#categories').select2({
        allowClear: true,
        placeholder: 'Select a category',
    })
    $('#origins, #names, #collections, #communities, #schools, #objects, #locations, #subjects, #artists, #dates')
        .each(function () {
            var $this = $(this)

            $this.select2({
                // placeholder: "Choose origin...",
                minimumInputLength: 2,
                ajax: {
                    url: '/api/autocomplete',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: $.trim(params.term),
                            type: $this.attr('id'),
                            project: window.project,
                        }
                    },
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            }),
                        }
                    },
                    cache: true,
                },
            })
        })
})

var laravel = {
   initialize: function () {
     this.methodLinks = $('a[data-method]')
     this.token = $('a[data-token]')
     this.registerEvents()
   },

   registerEvents: function () {
     this.methodLinks.on('click', this.handleMethod)
   },

   handleMethod: function (e) {
     var link = $(this)
     var httpMethod = link.data('method').toUpperCase()
     var form

     // If the data-method attribute is not PUT or DELETE,
     // then we don't know what to do. Just ignore.
     if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
       return
     }

     // Allow user to optionally provide data-confirm="Are you sure?"
     if (link.data('confirm')) {
       if (!laravel.verifyConfirm(link)) {
         return false
       }
     }

     form = laravel.createForm(link)
     form.submit()

     e.preventDefault()
   },

   verifyConfirm: function (link) {
     return confirm(link.data('confirm'))
   },

   createForm: function (link) {
     var form =
     $('<form>', {
       method: 'POST',
       action: link.attr('href'),
     })

     var token =
     $('<input>', {
       type: 'hidden',
       name: '_token',
       value: link.data('token'),
       })

     var hiddenInput =
     $('<input>', {
       name: '_method',
       type: 'hidden',
       value: link.data('method'),
     })

     return form.append(token, hiddenInput)
                .appendTo('body')
   },
 }

 laravel.initialize()
