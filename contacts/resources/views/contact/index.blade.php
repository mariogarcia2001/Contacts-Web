@extends('layouts.app')

@section('template_title')
    Contact
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Contact') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Number</th>
										<th>Email</th>
										<th>Organization</th>
										<th>Charge</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $contact->name }}</td>
											<td>{{ $contact->number }}</td>
											<td>{{ $contact->email }}</td>
											<td>{{ $contact->organization }}</td>
											<td>{{ $contact->charge }}</td>

                                            <td>
                                                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('contacts.show',$contact->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('contacts.edit',$contact->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <span>Numeros de elementos por pagina: &nbsp</span>
                        <form>
                            <select id="pagination">
                                <option value="3" @if($items = 3) selected @endif >3</option>
                                <option value="6" @if($items = 6) selected @endif >6</option>
                                <option value="12" @if($items = 12) selected @endif >12</option>
                                <option value="15" @if($items = 15) selected @endif >15</option>
                            </select>
                        </form>
                    </div>                   
                </div>
                <div style="display: flex; justify-content: center; align-items: center;">
                {{ $contacts->links() }} 
                </div>

            </div>
            
            <script>
                document.getElementById('pagination').onchange = function() {
                window.location = "{{ $contacts->url(1) }}&items=" + this.value;
                };
            </script>
        </div>
    </div>
    
@endsection
