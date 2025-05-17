@extends('admin.layouts.master')

@section('head-tag')
<title>پیام های تماس با ما</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">پیام های تماس با ما</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>پیام های تماس با ما</h5>
            </section>
            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>موضوع</th>
                            <th>تاریخ</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $key => $contact)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ jdate($contact->created_at) }}</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.contact.show', $contact->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> مشاهده
                                </a>


                                <form class="d-inline" action="{{ route('admin.contact.destroy', $contact->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-outline-danger btn-sm delete" type="submit" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            {{$contacts->links()}}
        </section>
    </section>
</section>
@endsection
@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
