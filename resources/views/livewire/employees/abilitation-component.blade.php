<div class="pt-3">
    <div class="row ">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Habilitaciones</h3>
                </div>
                <form action="{{ route('abilitaciones.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Salario</label>
                                    <input class="form-control" id="description" name="salary" required></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">LISTA DE HABILITACIONES</h3>
                </div>
                <div class="card-body">
                    <input type="text" wire:model.live="search" class="form-control"
                        placeholder="INGRESE EL NOMBRE DE LA HABILITACION">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Salario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abilitations as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->salary }}</td>
                                    <td>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateModal"
                                            wire:click="edit({{ $item->id }})">Editar</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" wire:click="showDelete('{{ $item->id }}','{{ $item->name }}','{{ $item->salary }}')"  
                                        data-bs-target="#deleteModal">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" wire:ignore.self tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">ACTUALIZAR HABILITACIÓN </h1>
                    <div class="loading">
                        <span wire:loading role="status" class="fas fa-spinner fa-spin"></span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" wire:model="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Salario</label>
                            <input type="text" class="form-control" wire:model="salary" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="update({{ $idAbilitation }})" class="btn btn-primary">Guardar</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" wire:ignore.self tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">                    
                    <h1 class="modal-title fs-5" id="deleteModalLabel">ELIMINAR HABILITACIÓN </h1>
                
                        <span wire:loading role="status" class="fas fa-spinner fa-spin"></span>
                 
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>
                    <div class="modal-body">
                       <label for="name">¿Estás seguro de eliminar la habilitacion de {{ $name }}?"</label>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="delete({{ $idAbilitation }})" class="btn btn-danger">Eliminar</button>
                    </div>
            </div>
        </div>
    </div>


</div>