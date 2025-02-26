@extends('customer.layout.admin_header')
@section('content')

    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            
            <div class="row card-body">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <img src="gstin-icon.png" alt="GSTIN Icon" width="30" height="30" class="me-3">
                              <div>
                                <h6 class="mb-0">Add GSTIN</h6>
                                <small class="text-muted">Enter your registered GST Identification Number to add it to your freight and customer invoice</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                
                      <!-- Activate Early COD Section -->
                      <div class="col-md-6 mb-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <img src="cod-icon.png" alt="COD Icon" width="30" height="30" class="me-3">
                              <div>
                                <h6 class="mb-0">Activate Early COD</h6>
                                <small class="text-muted">Get COD remittance in just 2, 3 or 4 days (plan based) after order delivery</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
                    <!-- GSTIN Input Form -->
                    <div class="card p-3 mb-3">
                      <form>
                        <div class="mb-3">
                          <label for="gstin" class="form-label">GSTIN</label>
                          <input type="text" class="form-control" id="gstin" placeholder="Enter your primary GSTIN">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                    </div>
                  </div>


                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#whatsappTrackingModal">
                        Open WhatsApp Tracking Modal
                    </button>

                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                    <!-- Modal Structure -->
                    <div class="modal fade" id="whatsappTrackingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close close-btn" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="promo-section">
                                        <img src="https://yourlogo.com/shiprocket-logo.png" alt="Shiprocket Logo"
                                            class="img-fluid mb-3">
                                        <h1>Enhance Your Customer Experience with WhatsApp Tracking!</h1>
                                        <p>Get Real-Time Updates Directly to Your Buyers' Phones!</p>

                                        <div class="whatsapp-features">
                                            <div>
                                                <i class="bi bi-graph-up-arrow"></i>
                                                <h5>High Engagement</h5>
                                                <p>Benefit from a 90+% read rate, ensuring your customers stay informed.</p>
                                            </div>
                                            <div>
                                                <i class="bi bi-bell"></i>
                                                <h5>Real-Time Notifications</h5>
                                                <p>Keep your buyers updated with every step of their shipment.</p>
                                            </div>
                                            <div>
                                                <i class="bi bi-chat-left-text"></i>
                                                <h5>Reduce Queries</h5>
                                                <p>Lessen customer service load with proactive shipment information.</p>
                                            </div>
                                        </div>

                                        <div class="special-offer">
                                            Special Offer: Only 0.99 + GST per Tracking Message
                                        </div>

                                        <a href="#" class="activate-btn">Activate Now</a>

                                        <div class="mt-4">
                                            <p>Start your stress-free shipping journey now!</p>
                                            <i class="bi bi-whatsapp whatsapp-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection
@section('script')

@endsection
