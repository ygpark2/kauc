
    <div id="tabs"> 
        <ul> 
		    <li><a href="#" name="tab-geo-log">로그 남기기</a></li>        
		    <li><a href="#" name="tab-geo-business">업체 등록</a></li>        
		    <li><a href="#" name="tab-geo-job">구인/구직</a></li>
		    <li><a href="#" name="tab-geo-property">부동산</a></li>
		    <li><a href="#" name="tab-geo-userprofile">사용자 정보</a></li>
		    <li><a href="#" name="tab-geo-etc">기타</a></li> 
		</ul> 
 
        <div id="tab-geo-log">
			<div class="form">
				<p>
					<span>제목 : </span>
					<input type="text" id="log_title" size="75" />
				</p>
					<span>내용 : </span>
					<textarea id="log_content" cols="75" rows="10"></textarea>
				<p>
					<span>태그 : </span>
					<input type="text" id="log_tag" size="75" />
				</p>
				<div style="padding-left: 450px;">
					<input id="log_save_btn" type="button" value="저장" />
				</div>
			</div>
        </div>   
     
        <div id="tab-geo-business">
        	<div class='form'>
				<p>
					<label for="name">제목 : </label>
					<input type="text" name="title" id="business_title" size="70" />
				</p>
			</div>
			<form id="form1">
				<fieldset style="width: 250px;">
				<legend>Business form</legend>
				<p>
					<label for="email">이메일 : </label>
					<input type="text" name="email" id="business_email" size="30" />
				</p>
				<p>
					<label for="web">웹 사이트 : </label>
					<input type="text" name="url" id="business_url" size="30" value="http://" />
				</p>
				<p>
					<label for="web">전화 : </label>
					<input type="text" name="phone" id="business_phone" size="30" />
				</p>
				<p>
					<label for="web">카테고리 : </label>
					<div id="category_list"></div>
				</p>
			</fieldset>
			<fieldset style="width: 300px;">
				<p>
					<label for="message">업체 정보</label>
					<textarea name="business_message" id="business_content" cols="45" rows="10"></textarea>
				</p>
			</fieldset>
			<p class="submit" style="padding-left: 450px;"><input id="business_save_btn" type="button" value="저장" /></p>
			</form>
        </div> 
       
        <div id="tab-geo-job">
        	<div class='form'>
				<p>
					<label for="name">제목 : </label>
					<input type="text" name="title" id="job_title" size="70" />
				</p>
			</div>
			<form id="form1">
				<fieldset style="width: 250px;">
					<legend>Job form</legend>
					<p>
						<label for="email">이메일 : </label>
						<input type="text" id="job_email" size="30" />
					</p>
					<p>
						<label for="web">웹 사이트 : </label>
						<input type="text" id="job_url" size="30" value="http://" />
					</p>
					<p>
						<label for="web">전화 : </label>
						<input type="text" id="job_phone" size="30" />
					</p>
					<p>
						<label for="web">태그 : </label>
						<input type="text" id="job_tag" size="30" />
					</p>
				</fieldset>
				<fieldset style="width: 300px;">
					<p>
						<label for="message">구인/구직 상세 내역</label>
						<textarea name="message" id="job_content" cols="45" rows="10"></textarea>
					</p>
				</fieldset>
				<p class="submit" style="padding-left: 450px;"><input id="job_save_btn" type="button" value="저장" /></p>
			</form>
        </div>    

        <div id="tab-geo-property">
        	<div class='form'>
				<p>
					<label for="name">제목 : </label>
					<input type="text" name="title" id="property_title" size="70" />
				</p>
			</div>
			<form id="form1">
				<fieldset style="width: 250px;">
					<legend>Property form</legend>
					<p>
						<label for="email">이메일 : </label>
						<input type="text" name="email" id="property_email" size="30" />
					</p>
					<p>
						<label for="web">웹 사이트 : </label>
						<input type="text" name="url" id="property_url" size="30" value="http://" />
					</p>
					<p>
						<label for="web">전화 : </label>
						<input type="text" name="phone" id="property_phone" size="30" />
					</p>
					<p>
						<label for="web">형태 : 
						<select id="property_type" name="type">
							<option value="1">렌트(임대)-weekly(주당)</option>
							<option value="2">렌트(임대)-monthly(월당)</option>
							<option value="3">매매</option>
							<option value="4">전세</option>
						</select>
						</label>
				
					</p>
					<p>
						<label for="web">가격 : </label>
						<input type="text" name="price" id="property_price" size="20" />
						<input type="text" name="price_unit" id="property_price_unit" size="7" value="호주달러"/>
					</p>
				</fieldset>
				<fieldset style="width: 300px;">
					<p>
						<label for="message">부동산 상세 내용</label>
						<textarea name="message" id="property_content" cols="45" rows="10"></textarea>
					</p>
				</fieldset>
				<p class="submit" style="padding-left: 450px;"><input id="property_save_btn" type="button" value="저장" /></p>
			</form>
        </div> 

        <div id="tab-geo-userprofile">
			<form id="form1">
				<fieldset style="width: 270px;">
					<legend>Property form</legend>
					<p>
						<label class="grey" for="name">이름 : </label>
						<input type="text" id="name" size="15" />
					</p>
					<p>
						<label class="grey" for="mobile">핸드폰 : </label>
						<input type="text" id="mobile" size="15" />
					</p>
					<p>
						<label class="grey" for="phone">전화 : </label>
						<input type="text" id="phone" size="15" />
					</p>
					<p>
						<label class="grey" for="birth">생 일 : </label>
						<select id='birth_year'>
							<?php 
							for ($start_year = 1960; $start_year < 2011; $start_year++) {
								echo "<option value='" . $start_year . "'>" . $start_year . "</option>";
							}
							?>
						</select>년 
						<select id='birth_month'>
							<?php 
							for ($start_month = 1; $start_month <= 12; $start_month++) {
								echo "<option value='" . $start_month . "'>" . $start_month . "</option>";
							}
							?>
						</select>월 
						<select id='birth_day'>
							<?php 
							for ($start_day = 1; $start_day <= 31; $start_day++) {
								echo "<option value='" . $start_day . "'>" . $start_day . "</option>";
							}
							?>
						</select>일 
					</p>
					<p>
						<label class="grey" for="twitter">트위터 아이디 : </label>
						<input type="text" id="twitter" size="15" />
					</p>
					<p>
						<label class="grey" for="facebook">페이스북 아이디 : </label>
						<input type="text" id="facebook" size="15" />
					</p>
					<p>
						<label class="grey" for="occupation">직업 : </label>
						<input type="text" id="occupation" size="35" />
					</p>
					<p>
						<label class="grey" for="url">홈 페이지 : </label>
						<input type="text" id="url"  size="35" value="http://" />
					</p>
				</fieldset>
				<fieldset style="width: 300px;">
					<label class="grey" for="introduction">소개 : </label>
					<textarea id="introduction" cols="45" rows="10"></textarea>
					<!-- 
					<p>
						<label for="message">부동산 상세 내용</label>
						<textarea name="message" id="property_content" cols="45" rows="10"></textarea>
					</p>
					 -->
				</fieldset>
				<p class="submit" style="padding-left: 450px;"><input id="profile_save_btn" type="button" value="저장" /></p>
			</form>
        </div> 

        <div id="tab-geo-etc">
			<ul>
				<li> <a id="registerFavoriteAreaBtn" href="#">[이곳을 우리집으로 등록하기]</a> </li>
				<li> <a id="registerHomeAreaBtn" href="#">[이곳을 관심 지역으로 등록하기]</a> </li>
			</ul>
			<br /><br /><br /><br /><br />
			<br /><br /><br /><br /><br />
			<br /><br /><br /><br /><br />
        </div>

    </div>
