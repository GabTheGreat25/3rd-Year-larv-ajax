$(document).ready(function () {
  $('#ctable').DataTable({
    ajax: {
      //laman nung html ito basically
      url: '/api/camera',
      dataSrc: '',
    },
    dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
    buttons: [
      {
        extend: 'pdf',
        className: 'btn btn-success glyphicon glyphicon-file',
      },
      {
        extend: 'excel',
        className: 'btn btn-success glyphicon glyphicon-list-alt',
      },
      {
        text: 'Add camera',
        className: 'btn btn-success',
        action: function (e, dt, node, config) {
          $('#cform').trigger('reset')
          $('#cameraModal').modal('show')
        },
      },
    ],
    columns: [
      {
        data: 'camera_id',
      },
      {
        data: 'model',
      },
      {
        data: 'shuttercount',
      },
      {
        data: 'quantity',
      },
      {
        data: 'costs',
      },
      {
        data: null,
        render: function (data, type, JsonResultRow, row) {
          return (
            '<img src="storage/' +
            JsonResultRow.image_path +
            '" height="100px" width="100px">'
          )
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return (
            "<a href='#' class='editBtn' id='editbtn' data-id=" +
            data.camera_id +
            "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
            data.camera_id +
            "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
          )
        },
      },
    ],
  })

  $('#cameraSubmit').on('click', function (e) {
    // when you click save or create ito
    e.preventDefault()
    var data = $('#cform')[0]
    console.log(data)
    let formData = new FormData(data)
    console.log(formData)
    for (var pair of formData.entries()) {
      console.log(pair[0] + ',' + pair[1])
    }

    $.ajax({
      type: 'POST',
      url: '/api/camera',
      data: formData,
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#cameraModal').modal('hide')
        var $ctable = $('#ctable').DataTable()
        $ctable.ajax.reload()
        $ctable.row.add(data.camera).draw(false)
      },
      error: function (error) {
        console.log(error)
      },
    })
  })

  $('#ctable tbody').on('click', 'a.deletebtn', function (e) {
    // pag magbubura ka
    var table = $('#ctable').DataTable()
    var id = $(this).data('id')
    var $row = $(this).closest('tr')

    console.log(id)
    e.preventDefault()
    bootbox.confirm({
      message: 'do you want to delete this camera',
      buttons: {
        confirm: {
          label: 'yes',
          className: 'btn-success',
        },
        cancel: {
          label: 'no',
          className: 'btn-danger',
        },
      },
      callback: function (result) {
        console.log(result)
        if (result)
          $.ajax({
            type: 'DELETE',
            url: `/api/camera/${id}`,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
            success: function (data) {
              console.log(data)
              // bootbox.alert('success');
              $row.fadeOut(4000, function () {
                table.row($row).remove().draw(false)
              })
              bootbox.alert(data.success)
            },
            error: function (error) {
              console.log(error)
            },
          })
      },
    })
  })

  $('#ctable tbody').on('click', 'a.editBtn', function (e) {
    // pag mag edit ka pero titignan nya muna if existing ito
    e.preventDefault()
    $('#cameraModal').modal('show')
    var id = $(this).data('id')

    $.ajax({
      type: 'GET',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      url: `/api/camera/${id}/edit`,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#camera_id').val(data.camera_id)
        $('#model').val(data.model)
        $('#shuttercount').val(data.shuttercount)
        $('#quantity').val(data.quantity)
        $('#costs').val(data.costs)
        $('#image_path').val(data.image_path)
      },
      error: function (error) {
        console.log(error)
      },
    })
  })

  $('#cameraUpdate').on('click', function (e) {
    //dito na nya uupdate
    e.preventDefault()
    var id = $('#camera_id').val()
    var data = $('#cform')[0]
    let formData = new FormData(data)
    console.log(formData)
    for (var pair of formData.entries()) {
      console.log(pair[0] + ',' + pair[1])
    }
    var table = $('#ctable').DataTable()
    console.log(id)

    $.ajax({
      type: 'POST',
      url: `/api/camera/post/${id}`,
      data: formData,
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#cameraModal').modal('hide')
        table.ajax.reload()
      },
      error: function (error) {
        console.log(error)
      },
    })
  })
})
