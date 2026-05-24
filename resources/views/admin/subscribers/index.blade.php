@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')

@section('content')
    <div class="mb-4">
        <h1 class="h2 fw-bold mb-1">Newsletter Subscribers</h1>
        <p class="text-muted-soft mb-0">Emails collected from newsletter forms. Duplicate emails are blocked by validation and database uniqueness.</p>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Subscribed At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers as $subscriber)
                        <tr>
                            <td class="fw-bold">{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->created_at->format('M d, Y h:i A') }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" onsubmit="return confirm('Delete this subscriber?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3"><div class="empty-state">No subscribers found.</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $subscribers->links() }}
    </div>
@endsection
