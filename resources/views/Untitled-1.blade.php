                            <a href="{{route('levels.destroy', $level->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $level->id }}, '{{ $level->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $level->id }}" action="{{route('levels.destroy', $level->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
