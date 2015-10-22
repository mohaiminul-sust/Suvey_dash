@extends('layouts.default')

@section('content')
	<!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Projects Details
                  </header>

              </section>
              <div class="row">
                  <div class="col-md-8">
                      <section class="panel">
                          <div class="bio-graph-heading project-heading">
                              <strong> [ {{ $survey->title }} ] </strong>
                          </div>
                          <div class="panel-body bio-graph-info">
                              <!--<h1>New Dashboard BS3 </h1>-->
                              <div class="row p-details">
                                  <div class="bio-row">
                                      <p><span class="bold">Created by </span>: {{ $survey->user->username }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Created at </span>: {{ $survey->getSurveyCreatedDate() }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Questions </span>: {{ $survey->questions->count() }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Last Updated</span>: {{ $survey->getSurveyUpdatedDate() }}</p>
                                  </div>
                                 
                                  
                              </div>

                          </div>

                      </section>

                      <section class="panel">
                        <header class="panel-heading">
                          Last Activity
                        </header>
                        <div class="panel-body">
                            <table class="table table-hover p-table">
                          <thead>
                          <tr>
                              <th>Title</th>
                              <th>Start Time</th>
                              <th>End Time</th>
                              <th>Commnets</th>
                              <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>
                                  Project analysis
                              </td>
                              <td>
                                 18/11/2014 9:28:23
                              </td>
                              <td>
                                  28/11/2014 12:23:03
                              </td>
                              <td>
                                   Ipsum is that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Completed</span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  Requirement Collection
                              </td>
                              <td>
                                  10/11/2014 9:28:23
                              </td>
                              <td>
                                  22/11/2014 12:23:03
                              </td>
                              <td>
                                  Tawseef Ipsum is that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Reported</span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  Design Implement
                              </td>
                              <td>
                                  18/11/2014 9:28:23
                              </td>
                              <td>
                                  28/11/2014 12:23:03
                              </td>
                              <td>
                                  Dism Ipsum is that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Accepted</span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  Widget Management
                              </td>
                              <td>
                                  18/11/2014 9:28:23
                              </td>
                              <td>
                                  28/11/2014 12:23:03
                              </td>
                              <td>
                                  Cosm Ipsum is that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Completed</span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  Contact Info
                              </td>
                              <td>
                                  18/11/2014 9:28:23
                              </td>
                              <td>
                                  28/11/2014 12:23:03
                              </td>
                              <td>
                                  Hello that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Sent</span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  Project analysis
                              </td>
                              <td>
                                  18/11/2014 9:28:23
                              </td>
                              <td>
                                  28/11/2014 12:23:03
                              </td>
                              <td>
                                   Ipsum is that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Completed</span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  Project analysis
                              </td>
                              <td>
                                  18/11/2014 9:28:23
                              </td>
                              <td>
                                  28/11/2014 12:23:03
                              </td>
                              <td>
                                  Orem psum is that it has a as opposed to using Lorem Ipsum is that it has a as opposed to using
                              </td>
                              <td>
                                  <span class="label label-info">Completed</span>
                              </td>
                          </tr>
                          </tbody>
                          </table>
                        </div>
                      </section>

                  </div>
                  
              </div>
              <!-- page end-->
@stop