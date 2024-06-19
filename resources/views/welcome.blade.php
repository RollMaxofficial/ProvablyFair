@extends('layouts.app')

@section('content')
<nav class="topnav navbar  navbar-light bg-white fixed-top">
        <div class="container">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="./"><strong>> provably-fair.com</strong></a>
                <button class=" btn btn-outline-secondary" type="button"  onclick="toggleDesc()">
                        How It Works
                </button>
            </div>
            <div class="" style="">
                <a class=" " href="https://github.com/RollMaxofficial/ProvablyFair.git" >
                <button class=" btn btn-secondary" type="button" >
                  Get Source
                </button>
                  
                </a>
              
            </div>
        </div>
    </nav>
    <div class="bg-dark p-5">
       <div class="container provable-desc none">
    
                    <div class="col">
                        <h4 class="text-white">What is Provably Fair?</h4>
                        <p class="text-muted">Provably fair is a way to prove that a randomly generated number (or group of numbers) used in a game is not manipulated.</p>
                    </div>
                    <div class="col">
                        <h4 class="text-white">How It Works</h4>
                        <p class="text-muted">At the start of a game you (<code>the client</code>) are auto-assigned a random seed that you can use or change to whatever you'd like. The game (<code>the server</code>) also generates a random seed which it keeps <em><strong>private</strong></em>. The server seed is then cryptographically hashed and shown to the client <em><strong>before</strong></em> a game round takes place.</p>
                        <p class="text-muted">After the game round takes place the server seed (which was used to generate the hash) is revealed to the client. Once this is obtained the player can confirm that the server did indeed use this server seed to generate the hash from the previous round. Additionally, the client seed was used in conjunction with the server seed to generate the results that were used for that round, as evidenced by both the client seed and server seed producing the exact same result that was used in the game.</p>
                        <p class="text-muted">This same process repeats over and over again before and after each round. Before each round you will be presented with the hashed server seed which will be used for the next round. After that round you will be revealed the server seed used to generate that hash. If the hashes match, and the result is the same result you got in the game, then the outcome was provably fair.</p>
                        <h6 class="text-white">Types and Min/Max</h6>
                        <p class="text-muted">Different games require a different random number <code>type</code>. For example, a dice game may require a single <code>number</code> between <em><strong>0</strong></em> and <em><strong>10,000</strong></em> where a card game like Blackjack may require a <code>shuffle</code> which returns <em><strong>52</strong></em> random values which are then assigned to each unique card. For this reason there are different types of provably fair numbers which can be generated. Each type has a <code>minimum value</code> and a <code>maximum value</code> to be set depending on the range of values desired.</p>
                    </div>
                    <div class="col">
                        <h4 class="text-white">How To Verify</h4>
                        <p class="text-muted">Use the form below to verify a dataset of provably fair information. This data will run through the <code>PHP</code> algorithm found in the source code in the  <a href="https://github.com/RollMaxofficial/ProvablyFair.git">Github <em>provable</em> repository</a>. This is the exact same source code which is used to run this website. You can install this same website locally by following the instructions on the <a href="https://github.com/RollMaxofficial/ProvablyFair.git">Github <em>provable-laravel</em> repository</a>.</p>
                        <p class="text-center"><a href="https://github.com/RollMaxofficial/ProvablyFair.git" class="btn btn-primary"><!-- <i class="fab fa-github"></i> --> Get Source Code</a></p>
                    </div>
            
        </div>


        <div class="container verify-container">


            <h5 class="font-weight-bold spanborder"><span>Verify</span></h5>
            <form id="verifyForm">
                <div class="row" id="firstRow">
                    <div class="mb-3 col-lg-4">
                        <label for="exampleInputEmail1" class="form-label"><b>provableType</b></label>
                        <select class="form-select form-control" id="type" name="type" onchange="changeType(this.value)">
						
						  </select>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="exampleInputEmail1" class="form-label"><b>min</b></label>
                        <input type="number" class="form-control" id="min" name="min" value="1" disabled>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="exampleInputEmail1" class="form-label"><b>max</b></label>
                        <input type="number" class="form-control" id="max"  name="max" value="2" disabled>
                    </div>
                  

                    
                    <div class="mb-3 col-lg-3 none" id="shuffleType">
                        <label for="exampleInputEmail1" class="form-label"><b>Type</b></label>
                        <select class="form-select form-control" name="shuffleType" id="shuffleTypeInput" onchange="changeShuffleType(this.value)">
							<option value="1" selected>1</option> 
							<option value="2">2</option> 
							<option value="3">3</option> 
							<option value="4">4</option> 
							<option value="5">5</option> 
							
						  </select>
                    </div>
                    <div class="mb-3 col-lg-3 none" id="minesType">
                        <label for="exampleInputEmail1" class="form-label"><b>Type</b></label>
                        <input class="form-select form-control" type="number" min="1" max="24"  value="1" name="minesType" id="minesTypeInput"/>
						
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3  col-lg-4">
                        <label for="exampleInputPassword1" class="form-label"><b>Client Seed</b></label>
                        <input t type="text" class="form-control" name="clientSeed" id="clientSeed">
                    </div>
                    <div class="mb-3  col-lg-4">
                        <label for="exampleInputPassword1" class="form-label"><b>Nonce</b></label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="0" min="0"  id="nonce" name="nonce">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success btn-sm" type="button" onclick="decrement()">-</button>
                                <button class="btn btn-outline-success btn-sm" type="button" onclick="increment()">+</button>
                            </div>
                        </div>
                    </div>
        
                    <!-- <div class="mb-3  col-lg-4">
                        <label for="exampleInputPassword1" class="form-label"><b>number</b></label>
                        <input t type="text" class="form-control" value="0" disabled>
                    </div> -->
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><b>Server Seed</b></label>
                    <input type="text" class="form-control" name="serverSeed" id="serverSeed">
                </div>
                <div class="mb-3">
                    <label class="form-label"><b>Hashed Server Seed</b></label>
                    <input type="text" class="form-control" id="hashServerSeed" disabled>
                </div>
                <!-- <div class="mb-3">
                    <label class="form-label"><b>HashHmac</b></label>
                    <input type="text" class="form-control" id="hash" disabled>
                </div> -->

                <button type="submit" class="btn btn-primary">Get Results</button>
            </form>

        </div>
    </div>

    <div class=" p-5">

        <div class="container" >

            <h5 class="font-weight-bold spanborder"><span>Results</span></h5>
            <div id="results">
                 <ul id="number-result">
                    <li></li>
                </ul>
               
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <footer class="bg-white border-top p-3 text-muted small">
            <div class="row justify-content-center">
                <div>
                    Copyright &copy; 2024 . All rights reserved.
                </div>


            </div>
        </footer>
    </div>
    <!-- End Footer -->
@endsection