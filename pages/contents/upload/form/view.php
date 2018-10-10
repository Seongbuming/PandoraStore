<!doctype html>
<html xml:lang="ko" lang="ko">
<head>
    <?=$this->loadLayout("head")?>
    <link rel="stylesheet" href="/pages/contents/upload/form/stylesheet.css" />
    <script src="/pages/contents/upload/form/script.js"></script>
</head>

<body>
    <header>
        <?=$this->loadLayout("header")?>
    </header>

    <div id="contents">
        <form id="upload-form" action="/contents/upload/request" method="post" enctype="multipart/form-data">
            <h2>콘텐츠 등록</h2>

            <!-- 제목 -->
            <label for="Title">제목</label>
            <input id="Title" name="Title" type="text" placeholder="콘텐츠의 제목" required />

            <!-- 제작팀명 -->
            <label for="Creator-TeamName">제작팀명</label>
            <input id="Creator-TeamName" name="Creator-TeamName" type="text" placeholder="팀명" required />

            <!-- 제작팀원 -->
            <label for="Creator">제작팀원</label>
            <label for="Creator" class="description">제작자가 모두 판도라스토어에 가입되어 있어야 합니다.</label>
            <label for="Creator" class="description">모든 제작자는 콘텐츠에 대해 관리 권한을 가집니다.</label>
            <div class="input-creators">
                <input id="Creator" name="Creator" type="text" placeholder="팀원명" />
                <button class="add add-creator">
                    <i class="material-icons">&#xE145;</i>
                    <span>추가</span>
                </button>
            </div>
            <!-- 추가된 제작팀원들 -->
            <ul class="selected-items creators">
                <li class="no-item">팀원을 추가해 주세요.</li>
            </ul>

            <!-- 장르 -->
            <label for="Genre">장르</label>
            <div class="select-wrapper">
                <!-- 장르 목록 -->
                <select id="Genre">
                    <?php foreach ($this->getAttribute("genres") as $genre): ?>
                        <option value="<?=$genre["ID"]?>"><?=$genre["Name"]?></option>
                    <?php endforeach; ?>
                </select>
                <!-- 장르 선택 -->
                <button class="add add-genre">
                    <i class="material-icons">&#xE145;</i>
                    <span>추가</span>
                </button>
            </div>
            <!-- 선택한 장르들 -->
            <ul class="selected-items genres">
                <li class="no-item">장르를 추가해 주세요.</li>
            </ul>

            <!-- 플랫폼 -->
            <label for="Platform">플랫폼</label>
            <div class="select-wrapper">
                <!-- 플랫폼 목록 -->
                <select id="Platform">
                    <?php foreach ($this->getAttribute("platforms") as $platform): ?>
                        <option value="<?=$platform["ID"]?>"><?=$platform["Name"]?></option>
                    <?php endforeach; ?>
                </select>
                <!-- 플랫폼 선택 -->
                <button class="add add-platform">
                    <i class="material-icons">&#xE145;</i>
                    <span>추가</span>
                </button>
            </div>
            <!-- 선택한 플랫폼들 -->
            <ul class="selected-items platforms">
                <li class="no-item">플랫폼을 추가해 주세요.</li>
            </ul>

            <!-- 소개 -->
            <label for="Description">소개</label>
            <textarea id="Description" name="Description" placeholder="콘텐츠 열람 시 노출될 소개문" required></textarea>

            <!-- 파일 -->
            <input name="MAX_FILE_SIZE" type="hidden" value="<?=$this->getAttribute("MAX_FILE_SIZE")?>" /> <!-- 최대 용량 (Byte) -->
            <div class="files-header">
                <label>파일</label>
                <button class="add add-file">
                    <i class="material-icons">&#xE145;</i>
                    <span>추가</span>
                </button>
            </div>
            <ul class="files">
                <!-- 파일 항목 영역 템플릿 -->
                <template>
                    <!-- 파일 실행 환경 -->
                    <input class="platform-input" name="platform" type="text" placeholder="환경" required />

                    <!-- 파일 입력 영역 -->
                    <div class="file-input">
                        <!-- 파일 URL 입력 영역 -->
                        <div class="url">
                            <!-- 파일 URL -->
                            <input class="url-input" name="url" type="text" placeholder="URL 입력" />
                            <!-- 파일 URL 입력 확인 버튼 -->
                            <button class="url-apply">
                                <div>확인</div>
                            </button>
                        </div>

                        <span class="or">혹은</span>

                        <!-- 파일 선택 input -->
                        <input class="select-file" name="file" type="file" />
                        <!-- 파일 선택 버튼 -->
                        <button class="select-file-button">
                            <i class="material-icons">&#xE2C6;</i>
                            <span>파일 선택</span>
                        </button>
                    </div>

                    <!-- 파일 이름 출력 영역 -->
                    <div class="file-name"></div>

                    <!-- 파일 항목 삭제 버튼 -->
                    <div class="delete-wrapper">
                        <button class="delete">
                            <span class="blind">삭제</span>
                            <i class="material-icons">&#xE15B;</i>
                        </button>
                    </div>
                </template>
            </ul>

            <!-- 제출 버튼 -->
            <input class="button_style_1" type="submit" value="제출" />
        </form>
    </div>

    <!-- 장르 및 플랫폼 항목 템플릿 -->
    <template id="gp-item-template">
        <li>
            <!-- 장르 혹은 플랫폼의 이름 -->
            <span class="name"></span>

            <!-- 장르 혹은 플랫폼의 ID -->
            <input type="hidden" />

            <!-- 항목 삭제 버튼 -->
            <div class="delete-wrapper">
                <button class="delete">
                    <span class="blind">삭제</span>
                    <i class="material-icons">&#xE15B;</i>
                </button>
            </div>
        </li>
    </template>

    <footer>
        <?=$this->loadLayout("footer")?>
    </footer>
</body>
</html>
