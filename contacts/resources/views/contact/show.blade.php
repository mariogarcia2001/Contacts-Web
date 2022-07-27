@extends('layouts.app')

@section('template_title')
    {{ $contact->name ?? 'Show Contact' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Contact</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $contact->name }}
                        </div>
                        <div class="form-group">
                            <strong>Number:</strong>
                            {{ $contact->number }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $contact->email }}
                        </div>
                        <div class="form-group">
                            <strong>Organization:</strong>
                            {{ $contact->organization }}
                        </div>
                        <div class="form-group">
                            <strong>Charge:</strong>
                            {{ $contact->charge }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
