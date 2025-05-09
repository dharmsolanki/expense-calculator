@extends('layouts.app')

@section('title', 'Expense List')

@section('content')
@include('dashboard._search_form_expense')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        showConfirmButton: true,
        timer: 3000
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        showConfirmButton: true
    });
</script>
@endif
<div class="row justify-content-center mt-4">
    <div class="col-md-12"> {{-- Full width --}}
        @if ($expenses->isEmpty())
            <div class="alert alert-info text-center">
                No expenses found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Expense Name</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php $total = 0; @endphp
                        @foreach ($expenses as $expense)
                            <tr>
                                {{-- in Laravel Blade, $loop is a special variable available only inside @foreach loops --}}
                                <td>{{ $loop->iteration }}</td> 
                                <td>{{ $expense->expense_category }}</td>
                                <td>{{ $expense->expense_name }}</td>
                                <td><strong>₹{{ number_format($expense->expense_amount, 2) }}</strong></td>
                                <td>{{ $expense->payment_method }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d-m-Y') }}                                </td>
                                <td>{{ $expense->expense_description }}</td>
                                <td>
                                    <a href="{{ route('editExpense', $expense->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                            @php $total += $expense->expense_amount; @endphp
                        @endforeach
                        <tr class="table-secondary fw-bold">
                            <td colspan="3" class="text-end">Total</td>
                            <td colspan="1">₹{{ number_format($total, 2) }}</td>
                            <td colspan="4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
