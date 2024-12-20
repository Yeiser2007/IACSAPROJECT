<div>

        <div class="row col-12 mt-5">
            <div class="col-6">
                <div class="card">
                <div class="card-header">
                    <h5>Registrar vacaciones</h5>
                    {{ $id }}
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveVacation">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group col-12">
                                    <p class="h5">Empleado:</p>
                                   <input type="text" class="form-control" wire:model.live="employeeName" readonly>
                                    @error('employeeId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Fecha de ausencia:</p>
                                    <input type="date" class="form-control" wire:model.live="startDate">
                                    @error('startDate')
                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Fecha de regreso:</p>
                                    <input type="date" class="form-control" wire:model.live="endDate">
                                    @error('endDate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Dias restantes</p>
                                    <input type="text" class="form-control" wire:model.live="daysOfVacation">
                                    {{ $messageDays }}
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Comentarios:</p>
                                    <input type="text" class="form-control" wire:model.live="comments" name="comments">
                                    @error('comments')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {{ $comments }}
                                </div>
                            </div>
                            <div class="col-6">

                            </div>

                        </div>
                </div>
                <div class="card-footer d-flex justify-content-end align-items-end ">
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
                </form>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                <div class="card-header">
                    <h5>calculo acorde a (LFT 2023- Ley federal del trabajo)</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12">
                    <div class="col-6">
                    <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsiv">
                        <thead>
                            <tr>
                                <th>Año</th>
                                <th>Días de vacaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>6-10</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>11-15</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td>16-20</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>21-25</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <td>26-30</td>
                                <td>30</td>
                            </tr>
                        </tbody>
                          
                    </table>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                            <label for="vacation">Fecha de ingreso</label>
                            <input type="text" class="form-control" wire:model.live="hireDate" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vacation">Años de trabajo:</label>
                            <input type="text" class="form-control" wire:model.live="yearsOfWork" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vacation">Días de vacaciones:</label>
                            <input type="text" class="form-control" wire:model.live="days" readonly>
                        </div>
                    </div>
                    </div>

                   
                </div>
                <div class="card-footer d-flex justify-content-end align-items-end ">
                </div>
                </form>
                </div>
            </div>
        </div>
      




</div>
</div>