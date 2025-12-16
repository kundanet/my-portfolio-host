@extends('admin.layout')

@section('content')

{{-- PAGE TITLE --}}
<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Dashboard Analytics
</h1>

{{-- KPI CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    {{-- Skills --}}
    <div class="p-6 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 text-white shadow-xl 
                hover:scale-[1.02] transition-all duration-300 cursor-pointer"
         data-aos="zoom-in">
        <p class="text-sm opacity-80">Total Skills</p>
        <h2 id="skillsCount"
            class="text-5xl font-extrabold counter"
            data-target="{{ $skills }}">0</h2>
        <i data-lucide="sparkles" class="w-12 h-12 opacity-80 mt-4"></i>
    </div>

    {{-- Projects --}}
    <div class="p-6 rounded-xl bg-gradient-to-br from-pink-500 to-pink-700 text-white shadow-xl
                hover:scale-[1.02] transition-all duration-300 cursor-pointer"
         data-aos="zoom-in" data-aos-delay="80">
        <p class="text-sm opacity-80">Total Projects</p>
        <h2 id="projectsCount"
            class="text-5xl font-extrabold counter"
            data-target="{{ $projects }}">0</h2>
        <i data-lucide="folder-kanban" class="w-12 h-12 opacity-80 mt-4"></i>
    </div>

    {{-- Messages --}}
    <div class="p-6 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-xl
                hover:scale-[1.02] transition-all duration-300 cursor-pointer"
         data-aos="zoom-in" data-aos-delay="150">
        <p class="text-sm opacity-80">Messages</p>
        <h2 id="messagesCount"
            class="text-5xl font-extrabold counter"
            data-target="{{ $messages }}">0</h2>
        <i data-lucide="inbox" class="w-12 h-12 opacity-80 mt-4"></i>
    </div>

    {{-- Unread --}}
    <div class="p-6 rounded-xl bg-gradient-to-br from-red-500 to-red-700 text-white shadow-xl
                hover:scale-[1.02] transition-all duration-300 cursor-pointer"
         data-aos="zoom-in" data-aos-delay="220">
        <p class="text-sm opacity-80">Unread</p>
        <h2 id="unreadCount"
            class="text-5xl font-extrabold counter"
            data-target="{{ $unread }}">0</h2>
        <i data-lucide="bell-ring" class="w-12 h-12 opacity-80 mt-4"></i>
    </div>

</div>

{{-- MINI KPI WIDGETS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl" data-aos="fade-up">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Skills Added This Month</p>
        <h2 class="text-3xl font-bold mt-2 dark:text-white">{{ $skillsThisMonth }}</h2>
    </div>

    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl" data-aos="fade-up" data-aos-delay="100">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Projects This Month</p>
        <h2 class="text-3xl font-bold mt-2 dark:text-white">{{ $projectsThisMonth }}</h2>
    </div>

    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl" data-aos="fade-up" data-aos-delay="180">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Messages This Month</p>
        <h2 class="text-3xl font-bold mt-2 dark:text-white">{{ $messagesThisMonth }}</h2>
    </div>

</div>

{{-- CHARTS SECTION --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-12">

    {{-- Line Chart --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl" data-aos="fade-up">
        <h2 class="text-xl font-bold mb-4 dark:text-white">Projects Over Time</h2>
        <canvas id="lineChart" height="150"></canvas>
    </div>

    {{-- Bar Chart --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl" data-aos="fade-up" data-aos-delay="150">
        <h2 class="text-xl font-bold mb-4 dark:text-white">Messages Per Month</h2>
        <canvas id="barChart" height="150"></canvas>
    </div>

    {{-- Donut Chart --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl" data-aos="fade-up" data-aos-delay="250">
        <h2 class="text-xl font-bold mb-4 dark:text-white">System Overview</h2>
        <canvas id="donutChart" height="150"></canvas>
    </div>

</div>

@endsection


@section('scripts')
<script>
// ------------------------------
// COUNTER ANIMATION (ONCE)
// ------------------------------
document.querySelectorAll('.counter').forEach(counter => {
    let target = +counter.dataset.target;
    let count = 0;
    let step = Math.ceil(target / 40);

    const animate = () => {
        count += step;
        counter.textContent = count > target ? target : count;
        if (count < target) requestAnimationFrame(animate);
    };
    animate();
});

// ------------------------------
// CHART INIT
// ------------------------------
let lineChart, barChart, donutChart;

function initCharts(data) {

    lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: data.projectMonths,
            datasets: [{
                label: 'Projects',
                data: data.projectCounts,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.2)',
                tension: 0.4,
                borderWidth: 3,
                fill: true
            }]
        }
    });

    barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: data.messageMonths,
            datasets: [{
                label: 'Messages',
                data: data.messageCounts,
                backgroundColor: '#10b981',
                borderRadius: 8
            }]
        }
    });

    donutChart = new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Skills', 'Projects', 'Messages'],
            datasets: [{
                data: [data.skills, data.projects, data.messages],
                backgroundColor: ['#6366f1', '#ec4899', '#10b981']
            }]
        }
    });
}

// ------------------------------
// LIVE REFRESH (v7)
// ------------------------------
async function refreshDashboard() {
    const res = await fetch("{{ route('admin.dashboard.stats') }}");
    const data = await res.json();

    skillsCount.textContent   = data.skills;
    projectsCount.textContent = data.projects;
    messagesCount.textContent = data.messages;
    unreadCount.textContent   = data.unread;

    lineChart.data.labels = data.projectMonths;
    lineChart.data.datasets[0].data = data.projectCounts;
    lineChart.update();

    barChart.data.labels = data.messageMonths;
    barChart.data.datasets[0].data = data.messageCounts;
    barChart.update();

    donutChart.data.datasets[0].data = [
        data.skills,
        data.projects,
        data.messages
    ];
    donutChart.update();
}

// First load
fetch("{{ route('admin.dashboard.stats') }}")
    .then(res => res.json())
    .then(data => initCharts(data));

// Auto refresh every 6 seconds
setInterval(refreshDashboard, 6000);
</script>
@endsection
