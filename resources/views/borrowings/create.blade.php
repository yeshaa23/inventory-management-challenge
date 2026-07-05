<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Borrowing</p>
            <h2>Tambah Peminjaman</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">New Borrowing</p>
                    <h3>Form Tambah Peminjaman</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Catat peminjaman barang berdasarkan nama peminjam, divisi, tanggal pinjam, dan tanggal jatuh tempo.
                    </p>
                </div>

                <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                    Kembali
                </a>
            </div>

            <form action="{{ route('borrowings.store') }}" method="POST" class="gsm-form-layout">
                @csrf

                <div class="gsm-form-main">
                    <div class="gsm-form-grid">
                        <div class="gsm-field">
                            <label for="borrower_name">Nama Peminjam</label>

                            <input
                                type="text"
                                name="borrower_name"
                                id="borrower_name"
                                value="{{ old('borrower_name') }}"
                                placeholder="Contoh: Ayesha Hana"
                            >

                            @error('borrower_name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="division">Divisi</label>

                            <select name="division" id="division">
                                <option value="">Pilih Divisi</option>
                                <option value="IT" {{ old('division') == 'IT' ? 'selected' : '' }}>IT</option>
                                <option value="Finance" {{ old('division') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="Human Resources" {{ old('division') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                                <option value="Marketing" {{ old('division') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Sales" {{ old('division') == 'Sales' ? 'selected' : '' }}>Sales</option>
                                <option value="Operations" {{ old('division') == 'Operations' ? 'selected' : '' }}>Operations</option>
                                <option value="Customer Service" {{ old('division') == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                                <option value="General Affairs" {{ old('division') == 'General Affairs' ? 'selected' : '' }}>General Affairs</option>
                                <option value="Lainnya" {{ old('division') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>

                            @error('division')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="borrow_date">Tanggal Pinjam</label>

                            <input
                                type="date"
                                name="borrow_date"
                                id="borrow_date"
                                value="{{ old('borrow_date', date('Y-m-d')) }}"
                            >

                            @error('borrow_date')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="due_date">Tanggal Jatuh Tempo</label>

                            <input
                                type="date"
                                name="due_date"
                                id="due_date"
                                value="{{ old('due_date') }}"
                            >

                            <small>Digunakan untuk mendeteksi peminjaman terlambat.</small>

                            @error('due_date')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="product_id">Barang</label>

                            <select name="product_id" id="product_id">
                                <option value="">Pilih Barang</option>

                                @foreach($products as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        data-code="{{ $product->code }}"
                                        data-name="{{ $product->name }}"
                                        data-stock="{{ $product->stock }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}
                                    >
                                        {{ $product->code }} - {{ $product->name }} | Stok: {{ $product->stock }}
                                    </option>
                                @endforeach
                            </select>

                            @error('product_id')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="quantity">Jumlah</label>

                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                value="{{ old('quantity', 1) }}"
                                min="1"
                                placeholder="1"
                            >

                            @error('quantity')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            Simpan Peminjaman
                        </button>

                        <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                            Batal
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">↔</div>

                    <h4>Preview Peminjaman</h4>

                    <div class="gsm-preview-box">
                        <p>Barang Dipilih</p>
                        <strong id="preview-product">Belum dipilih</strong>
                    </div>

                    <ul>
                        <li>Pilih barang yang masih memiliki stok.</li>
                        <li>Isi tanggal jatuh tempo agar status terlambat dapat terdeteksi.</li>
                        <li>Pastikan divisi peminjam sudah sesuai.</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSelect = document.getElementById('product_id');
            const previewProduct = document.getElementById('preview-product');

            function updateProductPreview() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];

                if (!selectedOption || !selectedOption.value) {
                    previewProduct.textContent = 'Belum dipilih';
                    return;
                }

                const code = selectedOption.dataset.code || '-';
                const stock = selectedOption.dataset.stock || '0';

                previewProduct.textContent = `${code} | Stok ${stock}`;
            }

            if (productSelect) {
                productSelect.addEventListener('change', updateProductPreview);
                updateProductPreview();
            }
        });
    </script>
</x-app-layout>
