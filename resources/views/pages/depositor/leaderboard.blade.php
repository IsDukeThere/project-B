@extends('layouts.depositor')
@section('title', 'Peringkat Penyetor')
@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Peringkat Penyetor</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }} • Klasemen Akumulasi Poin</p>
    </div>

    <!-- Podium (Hanya Nampilin Data Kalau Leaderboard Nggak Kosong) -->
    @if(count($leaderboard) > 0)
    <div class="pb-card p-6 pt-8 bg-gradient-to-b from-slate-50/50 to-white overflow-x-auto">
        <div class="grid grid-cols-5 gap-2 sm:gap-4 items-end h-56 text-center min-w-[400px]">
            <!-- Peringkat 2 -->
            <div class="flex flex-col items-center justify-end h-full">
                @if(isset($leaderboard[1]))
                <span class="text-xs font-bold text-indigo-700 mb-1">{{ strtoupper(substr($leaderboard[1]->name, 0, 2)) }}</span>
                <span class="text-xs text-slate-600 truncate w-full mb-1">{{ explode(' ', $leaderboard[1]->name)[0] }}</span>
                @endif
                <div class="bg-slate-200/80 rounded-t-lg font-bold text-slate-500 flex items-center justify-center w-full h-36"><span>2</span></div>
            </div>

            <!-- Peringkat 1 -->
            <div class="flex flex-col items-center justify-end h-full">
                @if(isset($leaderboard[0]))
                <span class="text-xl mb-1">🥇</span>
                <span class="text-xs text-slate-700 truncate w-full mb-1 font-bold">{{ explode(' ', $leaderboard[0]->name)[0] }}</span>
                @endif
                <div class="bg-gradient-to-t from-amber-200 to-yellow-400 rounded-t-lg shadow-inner font-extrabold text-amber-900 flex items-center justify-center w-full h-48"><span>1</span></div>
            </div>

            <!-- Peringkat 3 -->
            <div class="flex flex-col items-center justify-end h-full">
                @if(isset($leaderboard[2]))
                <span class="text-xs font-bold text-purple-700 mb-1">{{ strtoupper(substr($leaderboard[2]->name, 0, 2)) }}</span>
                <span class="text-xs text-slate-700 truncate w-full mb-1 font-bold">{{ explode(' ', $leaderboard[2]->name)[0] }}</span>
                @endif
                <div class="bg-orange-200/80 rounded-t-lg font-bold text-orange-800 flex items-center justify-center w-full h-32"><span>3</span></div>
            </div>

            <!-- Peringkat 4 -->
            <div class="flex flex-col items-center justify-end h-full">
                @if(isset($leaderboard[3]))
                <span class="text-xs font-bold text-slate-600 mb-1">{{ strtoupper(substr($leaderboard[3]->name, 0, 2)) }}</span>
                <span class="text-xs text-slate-600 truncate w-full mb-1">{{ explode(' ', $leaderboard[3]->name)[0] }}</span>
                @endif
                <div class="bg-slate-100 rounded-t-lg font-bold text-slate-400 flex items-center justify-center w-full h-24"><span>4</span></div>
            </div>

            <!-- Peringkat 5 -->
            <div class="flex flex-col items-center justify-end h-full">
                @if(isset($leaderboard[4]))
                <span class="text-xs font-bold text-slate-600 mb-1">{{ strtoupper(substr($leaderboard[4]->name, 0, 2)) }}</span>
                <span class="text-xs text-slate-600 truncate w-full mb-1">{{ explode(' ', $leaderboard[4]->name)[0] }}</span>
                @endif
                <div class="bg-slate-50 rounded-t-lg font-bold text-slate-300 flex items-center justify-center w-full h-16"><span>5</span></div>
            </div>
        </div>
    </div>
    @endif

    <!-- Leaderboard Table -->
    <div class="pb-card p-0 overflow-hidden divide-y divide-slate-100">
        @forelse($leaderboard as $index => $u)
            @php $isMe = (Auth::id() == $u->id); @endphp
            <div class="p-4 flex items-center justify-between transition {{ $isMe ? 'bg-indigo-50/90 border-l-4 border-l-indigo-600' : 'hover:bg-slate-50' }}">
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-slate-500 w-5">{{ $index + 1 }}</span>
                    <div class="w-9 h-9 rounded-full bg-slate-200 font-bold text-xs flex items-center justify-center">
                        {{ strtoupper(substr($u->name, 0, 2)) }}
                    </div>
                    <div>
                        <span class="text-sm text-slate-900 block {{ $isMe ? 'font-black text-indigo-950' : 'font-semibold' }}">
                            {{ $u->name }} {{ $isMe ? '(Kamu)' : '' }}
                        </span>
                        <span class="text-xs text-slate-400">Total Akumulasi Bulanan</span>
                    </div>
                </div>

                <span class="text-sm font-bold {{ $isMe ? 'text-indigo-800' : 'text-slate-800' }}">
                    {{ $u->deposits_sum_poin_didapat ?? 0 }} poin
                </span>
            </div>
        @empty
            <div class="p-8 text-center text-xs text-slate-500 font-medium">Belum ada data setoran bulan ini.</div>
        @endforelse
    </div>
</div>
@endsection