@section('title', 'Groups')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Groups</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of {{ $count }} groups.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                <div class="nk-block-head-content">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <div class="drodown">
                                <a href="{{ route('groups.create') }}" class="dropdown-toggle btn btn-icon btn-primary"><em
                                        class="icon ni ni-plus"></em></a>
                            </div>
                        </li>
                    </ul>
                </div><!-- .nk-block-head-content -->
            @endif
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Group</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-id"><span class="">Group</span></th>
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-status d-none d-sm-inline-block">
                                        <span>Teacher</span>
                                    </span>
                                    <span class="tb-tnx-status d-md-inline-block d-none">
                                        <span class="d-none d-md-block">
                                            <span>Assistant</span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-info is-alt">
                                    <span class="tb-tnx-total">Students #</span>
                                </th>
                                <th class="tb-tnx-info is-alt">
                                    <span class="tb-tnx-total d-none d-md-inline-block">Days</span>
                                </th>
                                <th class="tb-tnx-info is-alt">
                                    <span class="tb-tnx-total">Lesson Time</span>
                                </th>
                                @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                                    <th class="tb-tnx-action">
                                        <span>&nbsp;</span>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $item)
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-id">
                                        <a href="{{ route('groups.show', $item->id) }}">
                                            <span style="text-transform: capitalize;">{{ $item->level }}
                                                {{ $item->name }}</span>
                                        </a>
                                    </td>
                                    <td class="tb-tnx-info">
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ $item->teacher_firstname }}
                                            </span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ $item->assistant_firstname }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-info is-alt">
                                        <div class="tb-tnx-status">
                                            11
                                        </div>
                                    </td>
                                    <td class="tb-tnx-info is-alt">
                                        <div class="tb-tnx-status">
                                            <span class="badge" style="text-transform: capitalize;">
                                                {{ $item->days }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-amount is-alt">
                                        <div class="tb-tnx-total">
                                            <span class="badge">{{ $item->lessonstarttime }}</span>
                                            <span class="badge">{{ $item->lessonendtime }}</span>
                                        </div>
                                    </td>
                                    @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                                        <td class="tb-tnx-action">
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                    data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="{{ route('groups.edit', $item->id) }}">Edit</a></li>
                                                        <form action="{{ route('groups.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <li><a href="#"
                                                                    data-confirm="Are you sure to delete this item?"
                                                                    onclick="event.preventDefault();this.closest('form').submit();">Remove</a>
                                                            </li>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($groups->hasPages())
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    {{ $groups->links() }}
                                </div>
                            </div><!-- .nk-block-between -->
                        </div><!-- .card-inner -->
                    @endif
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <script>
        $('.delete').on("click", function(e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                document.getElementById('form-service').submit();
            }
        });
    </script>
@endsection
