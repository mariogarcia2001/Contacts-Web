@section('title', __('Contacts'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Contact Listing </h4>
						</div
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Contacts">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Contacts
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.contacts.create')
						@include('livewire.contacts.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Name</th>
								<th>Number</th>
								<th>Email</th>
								<th>Organization</th>
								<th>Charge</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->name }}</td>
								<td>{{ $row->number }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->organization }}</td>
								<td>{{ $row->charge }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Contact id {{$row->id}}? \nDeleted Contacts cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
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
					<div style="display: flex; justify-content: center; align-items: center;">
                	{{ $contacts->links() }} 
                	</div>
					<script>
						document.getElementById('pagination').onchange = function() {
						window.location = "{{ $contacts->url(1) }}&items=" + this.value;
						};
					</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
