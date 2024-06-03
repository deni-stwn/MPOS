@extends('layouts.app')
@section('content')
    <div class="container duration-300" id="main-content">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">{{ trans('cruds.category.category') }}</h2>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full rounded-lg overflow-hidden">
                        <div class="flex justify-end mb-2">
                            <x-button type="button" classes="btn" click="openDrawer('drawer-add-user')">
                                + {{ trans('cruds.category.create') }}
                            </x-button>
                        </div>
                        <table id="table-product" class="min-w-full leading-normal">
                            <thead>
                                <tr class="text-center">
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ trans('cruds.category.category_name') }}
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ trans('cruds.global.store_id') }}
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ trans('cruds.global.created_by') }}
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ trans('cruds.store.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
