<div>
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Overview {{$currentMonthName}}
        </div>
        <h2 class="page-title">
            Dashboard
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <span class="d-sm-inline">
                    <label for="as">Kelas</label>
                    <select class="form-select">
                        <option value="">- Semua Kelas -</option>
                    </select>
                </span>
                <!-- <span class="d-sm-inline">
                    <label for="as">Jenis Pelanggaran</label>
                    <select class="form-select">
                        <option value="">- Semua Jenis Pelanggaran -</option>
                    </select>
                </span>
                <span class="d-sm-inline">
                    <label for="start">Start</label>
                    <input type="date" class="form-control" placeholder="">
                </span>
                <span class="d-sm-inline">
                    <label for="end">End</label>
                    <input type="date" class="form-control" placeholder="">
                </span>
                <span class="d-sm-inline">
                    <label for="end">Reset</label>
                    <button type="button" class="form-control btn btn-small bg-primary text-white">Refresh</button>
                </span> -->
            </div>
        </div>
    </div>
    <div class="row row-deck row-cards mt-2">
        <div class="col-12 col-lg-8">
            <div class="row row-cards align-content-start">
                <div class="col-12 col-lg-4">
                    <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-haze" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12h1"></path>
                                    <path d="M12 3v1"></path>
                                    <path d="M20 12h1"></path>
                                    <path d="M5.6 5.6l.7 .7"></path>
                                    <path d="M18.4 5.6l-.7 .7"></path>
                                    <path d="M8 12a4 4 0 1 1 8 0"></path>
                                    <path d="M3 16h18"></path>
                                    <path d="M3 20h18"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-bold">
                            <strong>{{$getTodaysTotalPenalty}}</strong> Total Pelanggaran
                            </div>
                            <div class="text-muted">
                            Hari ini
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                                    <path d="M16 3v4"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M4 11h16"></path>
                                    <path d="M11 15h1"></path>
                                    <path d="M12 15v3"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                            <strong>{{$getWeeksTotalPenalty}}</strong> Total Pelanggaran
                            </div>
                            <div class="text-muted">
                            Minggu ini
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path>
                                    <path d="M16 3v4"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M4 11h16"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                            <strong>{{$getMonthsTotalPenalty}}</strong> Total Pelanggaran
                            </div>
                            <div class="text-muted">
                            Bulan ini
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">5 Murid Dengan Pelanggaran Terbanyak</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nama Murid</th>
                                    <th>Kelas</th>
                                    <th>Hari Ini</th>
                                    <th>Minggu Ini</th>
                                    <th>Bulan Ini</th>
                                    <th>Semua</th>
                                    <th>Total Point</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentsPenalties as $data)
                                    <tr>
                                        <td>{{$data->student_fullname}}</td>
                                        <td>{{$data->classroom_name}}</td>
                                        <td>{{$data->penalties_today}}</td>
                                        <td>{{$data->penalties_this_week}}</td>
                                        <td>{{$data->penalties_this_month}}</td>
                                        <td>{{$data->penalties_all_time}}</td>
                                        <td>{{$data->total_penalties_points ? $data->total_penalties_points : 0 }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex w-100 justify-content-between">
                        <div class="subheader"><h3 class="card-title mb-0">10 Jenis Pelanggaran Terbanyak</h3></div>
                        <div class="">
                            <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- <a class="dropdown-item" href="#">Today's</a> -->
                                <a class="dropdown-item active" href="#">Last 7 days</a>
                                <!-- <a class="dropdown-item" href="#">Last 30 days</a>
                                <a class="dropdown-item" href="#">Last 12 months</a> -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                    <th>Jenis Pelanggaran</th>
                    <th colspan="2">Jumlah Murid</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getTop10PenaltyTypes as $data)
                        <tr>
                        <td>{{$data->penalty_type_name}}</td>
                        <td>{{$data->total_students}}</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: {{($data->total_students/$getTotalStudent)*100}}%"></div>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
