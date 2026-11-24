@extends('layouts.app')
@section('title','Statistik Pariwisata')

@section('content')

<section class="page-banner">
    <div class="page-banner-bg" style="background-image:url('{{ asset('images/hero/hero-bg-3.jpg') }}')"></div>
    <div class="page-banner-overlay"></div>
    <div class="container page-banner-content">
        <div style="display:inline-flex;align-items:center;gap:10px;background:rgba(255,255,255,.12);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.2);padding:6px 16px;border-radius:20px;margin-bottom:14px">
            <span><i class="bi bi-bar-chart-fill text-white"></i></span>
            <span style="color:rgba(255,255,255,.85);font-size:.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.08em">Data Pariwisata</span>
        </div>
        <h1>Statistik Pariwisata Samarinda</h1>
        <p style="color:rgba(255,255,255,.75);font-size:1rem;max-width:500px;margin:10px 0 16px">
            Data dan informasi perkembangan sektor pariwisata Kota Samarinda
        </p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Statistik</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5" style="background:var(--light-bg)">
    <div class="container">

        {{-- KPI CARDS --}}
        <div class="row g-4 mb-5">
            @foreach([
                ['bi-graph-up-arrow','527.430','Kunjungan Wisatawan 2024','↑ 12.3% dari 2023','#1565C0'],
                ['bi-buildings','89','Hotel & Penginapan','↑ 5 unit baru 2024','#2E7D32'],
                ['bi-cash-coin','Rp 2,4 T','Pendapatan Sektor Wisata','↑ 18.7% dari 2023','#E65100'],
                ['bi-people-fill','12.450','Tenaga Kerja Pariwisata','↑ 8.2% dari 2023','#6A1B9A'],
            ] as $kpi)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div style="background:#fff;border-radius:14px;padding:24px;box-shadow:var(--shadow);border-top:4px solid {{ $kpi[4] }}">
                    <div style="font-size:1.8rem;margin-bottom:10px;color:{{ $kpi[4] }}"><i class="bi {{ $kpi[0] }}"></i></div>
                    <div style="font-size:1.7rem;font-weight:800;color:{{ $kpi[4] }};line-height:1;margin-bottom:6px">{{ $kpi[1] }}</div>
                    <div style="font-size:.85rem;font-weight:600;color:var(--text-main);margin-bottom:4px">{{ $kpi[2] }}</div>
                    <div style="font-size:.78rem;color:#2E7D32;font-weight:600">{{ $kpi[3] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- TABEL KUNJUNGAN --}}
        <div class="row g-4">
            <div class="col-lg-7" data-aos="fade-right">
                <div style="background:#fff;border-radius:14px;padding:28px;box-shadow:var(--shadow)">
                    <h5 style="font-weight:800;color:var(--primary);margin-bottom:6px"><i class="bi bi-calendar3 me-2"></i>Kunjungan Wisatawan per Bulan (2024)</h5>
                    <p style="color:var(--text-soft);font-size:.85rem;margin-bottom:20px">Data kunjungan wisatawan domestik dan mancanegara</p>
                    <div style="overflow-x:auto">
                        <table style="width:100%;border-collapse:collapse;font-size:.88rem">
                            <thead>
                                <tr style="background:var(--sky)">
                                    <th style="padding:10px 14px;text-align:left;color:var(--primary);font-weight:700;border-radius:8px 0 0 8px">Bulan</th>
                                    <th style="padding:10px 14px;text-align:center;color:var(--primary);font-weight:700">Domestik</th>
                                    <th style="padding:10px 14px;text-align:center;color:var(--primary);font-weight:700">Mancanegara</th>
                                    <th style="padding:10px 14px;text-align:center;color:var(--primary);font-weight:700;border-radius:0 8px 8px 0">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach([
                                    ['Januari',38420,520,38940],
                                    ['Februari',35210,480,35690],
                                    ['Maret',41350,610,41960],
                                    ['April',39800,590,40390],
                                    ['Mei',43200,680,43880],
                                    ['Juni',52400,820,53220],
                                    ['Juli',58900,940,59840],
                                    ['Agustus',55600,880,56480],
                                    ['September',47300,750,48050],
                                    ['Oktober',44100,700,44800],
                                    ['November',40800,630,41430],
                                    ['Desember',68900,1050,69950],
                                ] as $i => $row)
                                <tr style="border-bottom:1px solid var(--border);{{ $i%2==0 ? '' : 'background:var(--light-bg)' }}">
                                    <td style="padding:9px 14px;font-weight:600;color:var(--text-main)">{{ $row[0] }}</td>
                                    <td style="padding:9px 14px;text-align:center;color:var(--text-soft)">{{ number_format($row[1]) }}</td>
                                    <td style="padding:9px 14px;text-align:center;color:var(--text-soft)">{{ number_format($row[2]) }}</td>
                                    <td style="padding:9px 14px;text-align:center;font-weight:700;color:var(--primary)">{{ number_format($row[3]) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="background:var(--primary)">
                                    <td style="padding:10px 14px;color:#fff;font-weight:800;border-radius:8px 0 0 8px">TOTAL 2024</td>
                                    <td style="padding:10px 14px;text-align:center;color:var(--accent);font-weight:800">519.980</td>
                                    <td style="padding:10px 14px;text-align:center;color:var(--accent);font-weight:800">7.650</td>
                                    <td style="padding:10px 14px;text-align:center;color:var(--accent);font-weight:800;border-radius:0 8px 8px 0">527.430</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left">
                {{-- TOP DESTINASI --}}
                <div style="background:#fff;border-radius:14px;padding:28px;box-shadow:var(--shadow);margin-bottom:20px">
                    <h5 style="font-weight:800;color:var(--primary);margin-bottom:20px"><i class="bi bi-trophy-fill me-2 text-warning"></i>Top 5 Destinasi Terpopuler</h5>
                    @foreach([
                        ['Islamic Center Samarinda',95,'bi-building'],
                        ['Tepian Mahakam',88,'bi-water'],
                        ['Kebun Raya Unmul',72,'bi-tree'],
                        ['Kampung Kuliner',65,'bi-cup-hot'],
                        ['Wisata Sungai Mahakam',58,'bi-compass'],
                    ] as $i => $dest)
                    <div style="margin-bottom:14px">
                        <div style="display:flex;justify-content:space-between;margin-bottom:5px">
                            <span style="font-size:.87rem;font-weight:600;color:var(--text-main)"><i class="bi {{ $dest[2] }} me-2 text-primary"></i>{{ $dest[0] }}</span>
                            <span style="font-size:.82rem;font-weight:700;color:var(--primary)">{{ $dest[1] }}%</span>
                        </div>
                        <div style="background:var(--border);border-radius:20px;height:8px;overflow:hidden">
                            <div style="background:linear-gradient(90deg,var(--primary),var(--primary-light));height:100%;width:{{ $dest[1] }}%;border-radius:20px;transition:width 1s ease"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- ASAL WISATAWAN --}}
                <div style="background:#fff;border-radius:14px;padding:28px;box-shadow:var(--shadow)">
                    <h5 style="font-weight:800;color:var(--primary);margin-bottom:16px"><i class="bi bi-globe-americas me-2"></i>Asal Wisatawan</h5>
                    @foreach([
                        ['Kalimantan Timur','45%','var(--primary)'],
                        ['Kalimantan Selatan','18%','#2E7D32'],
                        ['Jawa','22%','#E65100'],
                        ['Sulawesi','8%','#6A1B9A'],
                        ['Mancanegara','7%','#C62828'],
                    ] as $a)
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border)">
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:12px;height:12px;border-radius:3px;background:{{ $a[2] }};flex-shrink:0"></div>
                            <span style="font-size:.87rem;color:var(--text-main)">{{ $a[0] }}</span>
                        </div>
                        <span style="font-weight:700;color:{{ $a[2] }};font-size:.88rem">{{ $a[1] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
