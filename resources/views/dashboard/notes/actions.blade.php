<a href="/notes/{{$id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                                <form action="/notes/{{$id}}" method="POST" style="display:inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
