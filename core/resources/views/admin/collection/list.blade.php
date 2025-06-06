@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card bg--light">
                <div class="card-body">
                    <small class="text-muted d-block mb-2">
                        <i class="la la-info-circle"></i> @lang('To display groups of products on the home page, you can create multiple product collections. Each collection allows you to organize specific products into a designated group for easy display. You can create as many collections as required to showcase products effectively on the home page.')
                    </small>


                    <small class="text-muted">
                        @lang('Each product collections will be treated as a single section and displayed on the website\'s home page. To enable these sections, add them from the') <a href="{{ route('admin.frontend.manage.section', 1) }}">@lang('Home Page Sections')</a>.
                    </small>


                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive-md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Total Products')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($collections as $collection)
                                    <tr>
                                        <td>{{ __($collection->title) }}</td>
                                        <td>{{ count($collection->product_ids) }}</td>
                                        <td>{{ showDateTime($collection->created_at, 'd M, Y') }}</td>
                                        <td>
                                            <div class="button--group">
                                                @if (Route::is('admin.collection.trashed'))
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-question="@lang('Are you sure to restore collection?')" data-action="{{ route('admin.collection.restore', $collection->id) }}"><i class="las la-trash-restore"></i>@lang('Restore')</button>
                                                @else
                                                    <a href="{{ route('admin.collection.update', $collection->id) }}" class="btn btn-sm btn-outline--primary"><i class="las la-pencil-alt"></i>@lang('Edit')</a>

                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to delete collection?')" data-action="{{ route('admin.collection.delete', $collection->id) }}"><i class="las la-trash-alt"></i>@lang('Delete')</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($collections->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($collections) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.collection.create') }}" class="btn btn-sm btn-outline--primary"><i class="las la-plus"></i>@lang('Add New')</a>
    <x-back :route="route('admin.frontend.index')"/>
@endpush
