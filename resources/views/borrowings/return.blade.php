<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Borrowing</p>
            <h2>Pengembalian Barang</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Return Item</p>
                    <h3>Form Pengembalian Barang</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Catat kondisi barang saat dikembalikan dan tambahkan catatan bila diperlukan.
                    </p>
                </div>

                <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                    Kembali
                </a>
            </div>

            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="gsm-form-layout">
                @csrf
                @method('PATCH')

                <div class="gsm-form-main">
                    <div class="gsm-panel !shadow-none !p-0 !border-0 mb-6">
                        <div class="gsm-table-wrapper">
                            <table class="gsm-table">
                                <tbody>
                                    <tr>
                                        <td class="font-bold">Nama Peminjam</td>
                                        <td>{{ $borrowing->borrower_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Divisi</td>
                                        <td>{{ $borrowing->division ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Tanggal Pinjam</td>
                                        <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Jatuh Tempo</td>
                                        <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="gsm-table-wrapper mb-6">
                        <table class="gsm-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($borrowing->details as $detail)
                                    <tr>
                                        <td class="font-bold text-slate-900">{{ $detail->product->code ?? '-' }}</td>
                                        <td>{{ $detail->product->name ?? '-' }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="gsm-form-grid">
                        <div class="gsm-field gsm-field-full">
                            <label for="return_condition">Kondisi Saat Dikembalikan</label>

                            <select name="return_condition" id="return_condition">
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik" {{ old('return_condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('return_condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('return_condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>

                            @error('return_condition')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="return_note">Catatan Pengembalian</label>

                            <textarea
                                name="return_note"
                                id="return_note"
                                rows="5"
                                placeholder="Contoh: Barang lengkap, ada lecet kecil, kabel hilang, dan sebagainya."
                            >{{ old('return_note') }}</textarea>

                            @error('return_note')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            Simpan Pengembalian
                        </button>

                        <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                            Batal
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">✓</div>

                    <h4>Checklist Pengembalian</h4>

                    <div class="gsm-preview-box">
                        <p>Status</p>
                        <strong>Dipinjam</strong>
                    </div>

                    <ul>
                        <li>Periksa kondisi fisik barang sebelum disimpan kembali.</li>
                        <li>Catat kerusakan atau kehilangan kelengkapan barang.</li>
                        <li>Stok akan otomatis bertambah setelah pengembalian disimpan.</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>
</x-app-layout>
