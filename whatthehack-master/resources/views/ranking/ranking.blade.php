@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold">{{ __('Global Ranking') }}</div>

            <div class="card-body">
                <table id="rankingTable" class="table table-bordered" cellspacing="0" width="100%" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th class="th-sm">Username</th>
                            <th class="th-sm">Overall Points</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ranked as $key => $value)
                        @if($value->username == $currentUser->username)
                            <tr bgcolor="#00c800">
                                <td>{{ $key }}</td>
                                <td>
                                    <form method="POST" action="{{ route('profile.search') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $value->username }}" name="username">
                                        <button type="submit" class="btn btn-link py-0">{{ $value->username }}</button>
                                    </form>
                                </td>
                                <td>{{ $value->points }}</td>
                            </tr>
                        @else
                        <tr>
                            <td>{{ $key }}</td>
                            <td>
                                <form method="POST" action="{{ route('profile.search') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $value->username }}" name="username">
                                    <button type="submit" class="btn btn-link py-0">{{ $value->username }}</button>
                                </form>
                            </td>
                            <td>{{ $value->points }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function () {
                        $('#rankingTable').DataTable();
                        $('.dataTables_length').addClass('bs-select');
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
