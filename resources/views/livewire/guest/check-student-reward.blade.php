<div>
    <div class="row row-deck row-cards align-items-start">
        <div class="col-lg-7 col-12">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-md">
                            <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7"></path><path d="M10 10l.01 0"></path><path d="M14 10l.01 0"></path><path d="M10 14a3.5 3.5 0 0 0 4 0"></path></svg>
                            </div>
                            </div>
                            <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                @if($totalPenaltyPoint == 0)
                                    <h3 class="h1">You got reward - <strong class="text-success">1000</strong></h3>
                                @elseif($totalPenaltyPoint)
                                    <h3 class="h1">Oh no, you making a violation, so your reward decreased - <strong class="text-success">{{1000 - $totalPenaltyPoint}}</strong> ☹️</h3>
                                @else 
                                    <h3 class="h1">Yeay, you still have reward - <strong class="text-success">1000</strong> 😎</h3>
                                @endif
                                    
                                <!--  -->
                                <!-- Yeay, you still have  -->
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($modelStudentPenalty))
                    @foreach($modelStudentPenalty as $data)
                    <div class="col-12 col-lg-4 mt-2">
                        <div class="card card-sm">
                            <div class="card-status-top bg-yellow"></div>
                            <div class="card-body">
                                <h3 class="card-title">{{$data->PenaltyType->penalty_type_name}}</h3>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col-auto text-danger">-{{$data->PenaltyType->penalty_type_point}} Point</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            
        </div>
        
        <div class="col-12 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Find my reward</h3>
                </div>
                <div class="card-body">
                    <div class="form-group position-relative">
                        <label class="form-label">Student Fullname</label>
                        <input type="text" class="form-control" wire:model.debounce.500ms="formStudentName" placeholder="Contoh: Dodid Praduga">
                        <small class="form-hint">Find by name</small>
                        @if(!empty($formStudentName) && !empty($formStudentNameSearchResult))
                            <div class="dropdown-menu dropdown-menu-demo position-absolute show" style="z-index:999; width:100%; box-shadow:0 1px 2px 0 rgba(0, 0, 0, 0.05)">
                                @if(!empty($formStudentNameSearchResult))
                                    @foreach($formStudentNameSearchResult as $item)
                                        <li class="dropdown-item" role="button" wire:click="setValue({{$item->id}},'{{$item->student_fullname}}')">{{$item->student_fullname}}</li>
                                    @endforeach
                                @endif
                                <li class="dropdown-item disabled">Add more keywords</li>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row align-items-center">
                    <!-- <div class="col">Butuh bantuan? <br><a href="https://api.whatsapp.com/send/?phone=+6281275402543&text=Halo%20Sekolah%20Kristen%20Basic,%20Saya%20Butuh%20Bantuan&app_absent=0" target="_blank">Klik disini untuk basic batam center</a> <br><a href="https://api.whatsapp.com/send/?phone=+6282391089711&text=Halo%20Sekolah%20Kristen%20Basic,%20Saya%20Butuh%20Bantuan&app_absent=0" target="_blank">disini untuk basic batu aji</a></div> -->
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger" wire:click="formReset()" @if($disabledBtn) disabled @endif>
                            Reset
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="search()" @if($disabledBtn) disabled @endif>
                            Check
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>