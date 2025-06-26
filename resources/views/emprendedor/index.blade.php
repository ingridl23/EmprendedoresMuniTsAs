@extends('layouts.app')

@section('template_title')
    Emprendedor
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Emprendedor') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('emprendedors.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Categoria</th>
										<th>Redes Id</th>
										<th>Imagen</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emprendedors as $emprendedor)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $emprendedor->nombre }}</td>
											<td>{{ $emprendedor->descripcion }}</td>
											<td>{{ $emprendedor->categoria }}</td>
											<td>{{ $emprendedor->redes_id }}</td>
											<td>{{ $emprendedor->imagen }}</td>

                                            <td>
                                                <form action="{{ route('emprendedors.destroy',$emprendedor->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('emprendedors.show',$emprendedor->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('emprendedors.edit',$emprendedor->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $emprendedors->links() !!}
            </div>
        </div>
    </div>
@endsection
