
            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of students</h3>

                    <div class="input-field">
                        <form action="{{ route('students.index') }}"" method="GET">
                        <select name="class_id" id="class_id">
                            <option>Search Class</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Search">
                        </form>
                    </div>

                    <a href="{{route('students.create')}}" class="button""><span class="material-icons-outlined">add</span></a>

                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp     @foreach ($students as $student)

                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{$student->serial_id}} </td>
                            <td>{{$student->surname}} {{$student->othername}}</td>
                            <td>{{$student->gender == 1 ? 'Male' : 'Female' }}</td>
                            <td>{{$student->level->name}}</td>
                            <td>{{$student->status == 1 ? 'Active' : 'Disabled'}}</td>
                            <td>
                                <div class="table-action">
                                    <a href="{{route('students.show', $student->id)}}" lable="view"><span class="material-icons-outlined">account_box</span></a>&nbsp;&nbsp;
                                    <a href="{{route('students.edit', $student->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                                    <form action="{{route('students.destroy', $student->id)}}" method="POST" id="deleteForm">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="#delete" class="formSubmit" id="formSubmit" type="submit" onclick="event.preventDefault(); confirmDelete()"><span class="material-icons-outlined">delete</span></a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
