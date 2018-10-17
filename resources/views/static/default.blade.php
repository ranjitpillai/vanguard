@extends('layouts.master')

@section('title', 'About')

@section('content')
<div class="container-fluid bg-secondary banner">
  <div class="container   ">
    <div class="row  ">
      <div class="col-md-12   ">
        <div class="float-lg-right mt-2"> <a href="{{ url('login') }}" class="btn btn-light "> Sign in</a> <a href="#" class="btn btn-light"> check status</a></div>
      </div>
      <div class="col-md-6  px-0">
        <div class="  p-1   text-white   ">
          <h3 class=" ">Consumer Complaint Center</h3>
          <p class="lead my-3">File an informal consumer complaint / Tell your story</p>
          <div>
            <div class="d-flex mb-3 ">
              <input type="email" class="form-control mr-1 w-50" id="exampleDropdownFormEmail2" placeholder="Search Complaint Center">
              <button type="submit" class="btn btn-primary">search</button>
            </div>
          </div>
          <p class="  mb-0">
          <p>Para presentar una queja en español, llamar al: 888-CALL-FCC (888-225-5322) </p>
        </div>
      </div>
      <div class="col-md-6  px-0">
        <div class="  p-3   text-white    ">
          <div class="float-none">
            <p class=" ">By <b>filing a consumer complaint</b> and <b>telling your story</b>, you contribute to federal enforcement and consumer protection efforts on a national scale and help us identify trends and track the issues that matter most.</p>
          </div>
          <a href="#" class="btn btn-light mb-1  flink"> File an Unwanted Call Complaint</a> <a href="#" class="btn btn-light mb-1  flink"> What Happens After I File My Complaint?</a> <a href="#" class="btn btn-light mb-1 flink">Frequently Asked Questions</a> <a href="#" class="btn btn-light flink"> How Other Agencies Can Help</a> </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid bg-light ">
  <div class="container  mt-5 ">
    <div class="row  mb-2">
      <div class="col-md-6">
        <div class="     mb-4  ">
          <div class="card-body  ">
            <h3 class="text-dark"  >File a complaint</h3>
            <p class="card-text mb-auto">If your complaint is about a telecom billing or service issue, we will serve your complaint on your provider. Your provider has 30 days to send you a response to your complaint. We encourage you to contact your provider to resolve your issue prior to filing a complaint. </p>
          </div>
          <div class="row p-md-4">
            <div class="  col-md-4 ">
              <div class="cc-category" alt="TV Issues" title="TV Issues"> <i class="fa fa-desktop fa-3x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/requests/new?ticket_form_id=33794">
                <p>TV</p>
                </a> <br>
              </div>
            </div>
            <div class="  col-md-4">
              <div class="cc-category" alt="Phone" title="Phone"> <i class="fa fa-phone fa-3x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/articles/360001201223">
                <p>Phone</p>
                </a> <br>
              </div>
            </div>
            <div class="  col-md-4">
              <div class="cc-category" alt="Internet" title="Internet"> <i class="fa fa-globe fa-3x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/articles/115002206106">
                <p>Internet</p>
                </a> <br>
              </div>
            </div>
            <div class="  col-md-4">
              <div class="cc-category" alt="Radio" title="Radio"> <i class="fa fa-microphone fa-3x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/requests/new?ticket_form_id=38844">
                <p>Radio</p>
                </a> <br>
              </div>
            </div>
            <div class="  col-md-4">
              <div class="cc-category" alt="Access for People with Disabilities" title="Access for People with Disabilities"> <i class="fa fa-child fa-3x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/articles/204231424-Accessibility-Complaint-Filing-Categories">
                <p>Access for People with Disabilities</p>
                </a> </div>
            </div>
            <div class="  col-md-4">
              <div class="cc-category" alt="Emergency Communications" title="Emergency Communications"> <i class="fa fa-ambulance fa-3x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/articles/115000914506-Emergency-Complaints">
                <p>Emergency Communications</p>
                </a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="    bg-light mb-4  ">
          <div class="card-body  ">
            <h3 class="text-dark mb-3"  > Share your experience</h3>
            <div class="  row">
              <div class="  col-md-4 pl-3">
                <div class="cc-category " alt="Tell Us Your Story" title="Tell Us Your Story"> <i class="fa fa-comments fa-5x fa-block"></i> <a class="" href="https://consumercomplaints.fcc.gov/hc/en-us/articles/115000430423-Tell-Us-Your-Story">
                  <p>Tell Us Your Story</p>
                  </a> <br>
                </div>
              </div>
              <div class="  col-md-8 pl-1 pr-0">
                <p class="">When you have issues concerning a provider or policy, let us know about it. By submitting your story you are NOT filing a consumer complaint. Your story won't be forwarded to your provider and you will not hear back from your provider or the FCC. We will share your story internally and use it to inform policy making and potential enforcement activities. </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <h2 class="container mb-3"> Learn about consumer issues</h2>
          <div class="col-md-6">
            <button type="button " class="btn btn-primary button-blue"><i class="fa fa-users fa-5x fa-block"></i>
            <p>Consumer Help Center</p>
            </button>
          </div>
          <div class="col-md-6">
            <button type="button" class="btn btn-primary button-blue"><i class="fa fa-chart-pie fa-5x fa-block"></i>
            <p>Consumer Complaint Data Center</p>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="mx-auto">
    <p  class="text-center">Download a complaint form: <a href="//p2.zdassets.com/hc/theme_assets/513073/200051444/Informal-Complaint-Form-Accessible.docx" aria-label="Download Word Complaint Form">Word</a> or <a href="https://p2.zdassets.com/hc/theme_assets/513073/200051444/12-2_Informal_Complaint_FormAccessible.pdf">PDF<span class="ae-compliance-indent" style="display:none;"> Downloadable Complaint Form </span></a></p>
    <p  class="text-center">File using our American Sign Language Hotline: <a href="https://consumercomplaints.fcc.gov/hc/en-us/articles/203402664">ASL Video</a></p>
  </div>
</div>
@endsection