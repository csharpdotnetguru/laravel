@extends("frontend.dynamo_init.layout")

@section("display")
<div class="container-fluid">


    <div class="row-fluid">
        <div class="span2">
            <!--Sidebar content-->
        </div>



        <div class="span7">
            <div>
                <div class="page-header">
                    <h2>Step 3: Select Operating System Type</h2>
                    <p>Please setup UnoDNS on your Computer/Tablet first before setting up on other TV devices. You will have the option
                        to setup on your TV device later.			  </p>
                </div>
            </div>


            <div class="row-fluid">
                <ul class="thumbnails">
                    <li class="span3">
                        <a href="http://help.unotelly.com/support/solutions/folders/29878" class="thumbnail">
                            <div class="thumbnail">
                                <img src="http://cdn.unotelly.com/unodns/images/windows_ostype.jpg">
                                <div class="caption">
                                    <p align="center">Windows</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="span3">
                        <a href="http://help.unotelly.com/support/solutions/folders/29879" class="thumbnail">
                            <div class="thumbnail">
                                <img src="http://www.unotelly.com/unodns/images/mac_ostype.jpeg">
                                <div class="caption">
                                    <p align="center">Mac</p>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="span3">
                        <a href="http://help.unotelly.com/support/solutions/folders/29880" class="thumbnail">
                            <div class="thumbnail">
                                <img src="http://cdn.unotelly.com/unodns/images/linux_ostype.jpg">
                                <div class="caption">
                                    <p align="center">Linux</p>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="span3">
                        <a href="http://help.unotelly.com/support/solutions" class="thumbnail">
                            <div class="thumbnail">
                                <img src="http://cdn.unotelly.com/unodns/images/no_computer2.jpg">
                                <br>
                                <div class="caption">
                                    <p align="center">Others</p>

                                </div>
                            </div>
                        </a>
                    </li>

                </ul>
            </div>


        </div>

        <div class="span2">
            <!--Sidebar content-->
        </div>
    </div>
</div>
@stop