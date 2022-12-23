@section('title', 'Create Student')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Settings</h3>
            <div class="nk-block-des">
                <p>CRM all settings</p>
            </div>
        </div>
        @if (session('success') || session('error'))
            <div class="example-alert">
                <div class="alert alert-primary alert-icon">
                    <em class="icon ni ni-alert-circle"></em> <strong>Message</strong>. {{ session('success') }}
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="example-alert">
                <div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em>
                    <strong>Message</strong>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button class="close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ route('settings.store') }}" class="form-validate" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="attendance_day">Attendance day
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="attendance_day" name="attendance_day"
                                        tabindex="1" value="{{ $info->attendance_day }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exam_pass">Exam pass
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="exam_pass" name="exam_pass"
                                        tabindex="2" value="{{ $info->exam_pass }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="price">Price
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="price" name="price" tabindex="2"
                                        value="{{ $info->price }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" onclick="this.form.setAttribute('novalidate', 'novalidate');'"
                                    class="btn btn-lg btn-primary" tabindex="14">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .nk-block -->

    <div class="nk-block">
        <h6 class="overline-title title">Group levels</h6>
        <div class="card card-bordered">
            <div class="card-inner">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col" style="width: 10px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($level as $item)
                            <tr>
                                <th scope="row">{{ $item->name }}</th>
                                <td>
                                    <button class="btn btn-sm btn-primary" id="edit-button" value="{{ $item->id }}"
                                        data-bs-toggle="modal" data-bs-target="#exam-anw">Edit</button>
                                    <form action="{{ route('settings.groupLevelDelete', $item->id) }}" method="post"
                                        id="level-delete">
                                        @csrf
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row" colspan="2">No data</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                <div class="form-control-wrap">
                    <form action="{{ route('settings.groupLevel') }}" method="POST">
                        <div class="input-group"><input type="text" class="form-control" name="name"
                                placeholder="Add new level" required="">
                            @csrf
                            <input type="hidden" name="type" value="add">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-dim">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="exam-anw">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Exam</h5>
                </div>
                <div class="modal-body">
                    <div class="row" id="exam-data">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="level_name">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" value=""
                                        id="level_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <input type="hidden" name="level_id" id="level_id">
                    <span class="sub-text"><button type="button" id="level_save"
                            class="btn btn-primary">Submit</button></span>
                </div>
            </div>
        </div>
    </div>
    <script>
        new AutoNumeric.multiple('.exam-result-input', {
            decimalPlaces: 0,
            minimumValue: 0,
            maximumValue: 100,
            watchExternalChanges: true
        });

        $('body').on('click', '#edit-button', function() {
            var level_id = $(this).val();
            console.log(level_id);
            // var link_id = link_id.split('-');
            // var student_id = link_id[0];
            // var exam_id = link_id[1];
            $.ajax({
                url: "/settings/groupLevel/" + level_id,
                type: "GET",
                success: function(data) {
                    if (data != null) {
                        $('#level_name').val(data.name);
                        $('#level_id').val(data.id);
                    } else {
                        $('#level_name').val('');
                        $('#level_id').val(0);
                    }
                }
            });
        });

        $("#level_save").click(function(e) {
            e.preventDefault();
            // Backend Validation
            var level_id = $('#level_id').val();
            var level_name = $('#level_name').val();
            console.log(level_id);
            $.ajax({
                url: "/settings/groupLevel/" + level_id,
                type: "PUT",
                data: {
                    id: level_id,
                    name: level_name,
                },
                success: function(data) {
                    $('#exam-anw').modal('hide');
                    // reset form
                    window.location.reload();
                }
            });
        });
        // $(".col-sm-4").on("input", function() {
        //     $("#result").text(resultExam());
        // });
        // $('#result').text(resultExam());

        // function resultExam() {
        //     var sum = 0;
        //     var result = 0;
        //     $('.col-sm-4 input').each(function() {
        //         if (this.id != 'team') {
        //             sum += Number($(this).val());
        //         }
        //         if (this.id == 'team') {
        //             result = sum / 5 + Number($(this).val());
        //         }
        //     });
        //     return result;
        // }
    </script>
@endsection
