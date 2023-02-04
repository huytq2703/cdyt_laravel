<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";

const trainings = [
    {
        name: "NGÀNH ĐIỀU DƯỠNG",
        child: [
            {
                tab_name: "Chương trình",
                content:
                    "<ul> <li> <strong>Điều dưỡng</strong> (tiếng Anh là Nursing) là một nghề nghiệp trong hệ thống y tế nhằm bảo vệ, nâng cao, tối ưu về sức khỏe và các khả năng; dự phòng bệnh và chấn thương; thực hiện nhiệm vụ xoa dịu nỗi đau qua chẩn đoán và điều trị đáp ứng con người; tăng cường chăm sóc sức khỏe cho các cá nhân, gia đình, cộng đồng và xã hội. </li> <li> <strong>Mục tiêu </strong>của ngành Điều dưỡng đó là đào tạo, xây dựng đội ngũ nhân viên, sinh viên có ý thức tổ chức kỷ luật, có trách nhiệm trước sức khỏe của người dân, người bệnh. Có phẩm chất đạo đức tốt, có thái độ đúng đắn, có kiến thức khoa học cơ bản vững chắc. Có kiến thức và kỹ năng thực hành nghề theo tiêu chuẩn. Có kiến thức tốt về khoa học xã hội - khoa học tự nhiên - khoa học chuyên ngành về khối ngành chăm sóc sức khỏe của người bệnh và ngành điều dưỡng, từ đó chăm sóc người bệnh, nâng cao sức khỏe cho người bệnh. </li> <li> Theo học ngành này, sinh viên sẽ được trang bị đầy đủ những kiến thức từ cơ bản đến nâng cao, được trang bị những kiến thức chuyên môn chuyên ngành tạo tiền đề tốt nhất phục vụ vấn đề làm việc sau khi ra trường. Được trang bị những kỹ năng mềm, kỹ năng bảo vệ và chăm sóc sức khỏe cho người bệnh, giúp người bệnh phục hồi và khỏi bệnh nhanh chóng. Biết kiểm tra tình tạng bệnh nhân, kê toa thuốc, trị liệu... </li> </ul>",
            },
            {
                tab_name: "Thời gian đào tạo",
                content:
                    '<table class="table table-bordered"> <tbody> <tr> <td><p> </p></td> <td><strong>Năm thứ nhất</strong></td> </tr> <tr> <td><p>1</p></td> <td>Những NLCBCCN Mác – Lênin 1</td> </tr> <tr> <td><p>2</p></td> <td>Ngoại ngữ (Tiếng Anh I)</td> </tr> <tr> <td><p>3</p></td> <td>Tin học đại cương</td> </tr> <tr> <td><p>4</p></td> <td>Xác xuất – Thống kê y học</td> </tr> <tr> <td><p>5</p></td> <td>Hóa học đại cương</td> </tr> <tr> <td><p>6</p></td> <td>Sinh học và Di truyền</td> </tr> <tr> <td><p>7</p></td> <td>Hoá sinh</td> </tr> <tr> <td><p>8</p></td> <td>Vật lý và lý sinh</td> </tr> <tr> <td><p>9</p></td> <td>Những NLCBCCN Mác – Lênin 2</td> </tr> <tr> <td><p>10</p></td> <td>Ngoại ngữ (Tiếng Anh II)</td> </tr> <tr> <td><p>11</p></td> <td>Giải phẫu – Mô phôi</td> </tr> <tr> <td><p>12</p></td> <td>Sinh lý</td> </tr> <tr> <td><p>13</p></td> <td>Sức khoẻ - Nâng cao sức khoẻ & hành vi con người</td> </tr> <tr> <td><p>14</p></td> <td>Sức khỏe môi trường</td> </tr> <tr> <td><p>15</p></td> <td>Tâm lý y học – Đạo đức y học</td> </tr> <tr> <td><p>16</p></td> <td>Nghiên cứu khoa học 1</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ hai</strong></td> </tr> <tr> <td><p>17</p></td> <td>Đường lối cách mạng của Đảng Cộng sản Việt Nam</td> </tr> <tr> <td><p>18</p></td> <td>Ngoại ngữ (Tiếng Anh III)</td> </tr> <tr> <td><p>19</p></td> <td>Vi sinh y học</td> </tr> <tr> <td><p>20</p></td> <td>Ký sinh trùng</td> </tr> <tr> <td><p>21</p></td> <td>Pháp luật và Tổ chức Y tế</td> </tr> <tr> <td><p>22</p></td> <td>Dược lý</td> </tr> <tr> <td><p>23</p></td> <td>Sinh lý bệnh – Miễn dịch</td> </tr> <tr> <td><p>24</p></td> <td>Kỹ năng giao tiếp trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>25</p></td> <td>Tư tưởng Hồ Chí Minh</td> </tr> <tr> <td><p>26</p></td> <td>Dinh dưỡng - Tiết chế</td> </tr> <tr> <td><p>27</p></td> <td>Dịch tễ học</td> </tr> <tr> <td><p>28</p></td> <td>Giáo dục sức khoẻ trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>29</p></td> <td>Điều dưỡng cơ sở I</td> </tr> <tr> <td><p>30</p></td> <td>Điều dưỡng cơ sở II</td> </tr> <tr> <td><p>31</p></td> <td>Kiểm soát nhiễm khuẩn trong thực hành điều dưỡng</td> </tr> <tr> <td><p>32</p></td> <td>Y học cổ truyền</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ ba</strong></td> </tr> <tr> <td><p>33</p></td> <td>Điều dưỡng cơ sở III</td> </tr> <tr> <td><p>34</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa I</td> </tr> <tr> <td><p>35</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa II, III</td> </tr> <tr> <td><p>36</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa I</td> </tr> <tr> <td><p>37</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa II, III</td> </tr> <tr> <td><p>38</p></td> <td>Chăm sóc sức khoẻ trẻ em I, II</td> </tr> <tr> <td><p>39</p></td> <td>Sức khoẻ phụ nữ, bà mẹ, gia đình và chăm sóc điều dưỡng I, II</td> </tr> <tr> <td><p>40</p></td> <td>Chăm sóc sức khoẻ người cao tuổi</td> </tr> <tr> <td><p>41</p></td> <td>Chăm sóc người bệnh cấp cứu & chăm sóc tích cực</td> </tr> <tr> <td><p>42</p></td> <td>Chăm sóc người cần được phục hồi chức năng</td> </tr> <tr> <td><p>43</p></td> <td>Chăm sóc sức khoẻ cộng đồng</td> </tr> <tr> <td><p>44</p></td> <td>Quản lý điều dưỡng</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ tư</strong></td> </tr> <tr> <td><p>45</p></td> <td>Chăm sóc sức khỏe người bệnh truyền nhiễm</td> </tr> <tr> <td><p>46</p></td> <td>Chăm sóc sức khỏe tâm thần</td> </tr> <tr> <td><p>47</p></td> <td>Điều dưỡng chuyên khoa hệ nội</td> </tr> <tr> <td><p>48</p></td> <td>Điều dưỡng chuyên khoa hệ ngoại</td> </tr> <tr> <td><p>49</p></td> <td>Nghiên cứu khoa học 2</td> </tr> <tr> <td><p>50</p></td> <td>TT Điều dưỡng cộng đồng</td> </tr> <tr> <td><p>51</p></td> <td>Chuyên khoa tự chọn</td> </tr> <tr> <td><p>52</p></td> <td>Thực tế tốt nghiệp</td> </tr> <tr> <td><p> </p></td> <td><strong>TỐT NGHIỆP</strong></td> </tr> <tr> <td><p>53</p></td> <td>Thi tốt nghiệp hoặc khóa luận</td> </tr> </tbody> </table>',
            },
            {
                tab_name: "Đối tượng tuyển sinh",
                content:
                    "<p><strong>Hình thức tuyển sinh:</strong> <span>XÉT TUYỂN HỒ SƠ</span></p> <p><strong>Đối tượng tuyển sinh:</strong></p> <p><span>Thí sinh thuộc một trong các đối tượng sau sẽ đủ điều kiện trở thành sinh viên của Cao đẳng</span></p> <ul> <li><span>Tốt nghiệp THPT hoặc tương đương;</span></li> <li><span>Sinh viên hệ chính quy các trường Cao đẳng, Đại học.</span></li> <li><span>Sinh viên đã hoàn thành chương trình Trung cấp và đã có bằng tốt nghiệp THPT hoặc tương đương.</span></li> </ul>",
            },
            {
                tab_name: "Học phí",
                content:
                    "<div><p><strong>Học phí áp dụng từ 01/01/2023</strong></p><ul><li>Học phí kỳ định hướng đóng 01 lần duy nhất</li><li>Học phí chuyên ngành đã bao gồm tiếng Anh, có 6 kỳ chuyên ngành</li><li>Đơn vị tính: Việt Nam đồng</li></ul></div>",
            },
        ],
    },
    {
        name: "NGÀNH DƯỢC",
        child: [
            {
                tab_name: "Chương trình",
                content:
                    "<ul> <li> <strong>Điều dưỡng</strong> (tiếng Anh là Nursing) là một nghề nghiệp trong hệ thống y tế nhằm bảo vệ, nâng cao, tối ưu về sức khỏe và các khả năng; dự phòng bệnh và chấn thương; thực hiện nhiệm vụ xoa dịu nỗi đau qua chẩn đoán và điều trị đáp ứng con người; tăng cường chăm sóc sức khỏe cho các cá nhân, gia đình, cộng đồng và xã hội. </li> <li> <strong>Mục tiêu </strong>của ngành Điều dưỡng đó là đào tạo, xây dựng đội ngũ nhân viên, sinh viên có ý thức tổ chức kỷ luật, có trách nhiệm trước sức khỏe của người dân, người bệnh. Có phẩm chất đạo đức tốt, có thái độ đúng đắn, có kiến thức khoa học cơ bản vững chắc. Có kiến thức và kỹ năng thực hành nghề theo tiêu chuẩn. Có kiến thức tốt về khoa học xã hội - khoa học tự nhiên - khoa học chuyên ngành về khối ngành chăm sóc sức khỏe của người bệnh và ngành điều dưỡng, từ đó chăm sóc người bệnh, nâng cao sức khỏe cho người bệnh. </li> <li> Theo học ngành này, sinh viên sẽ được trang bị đầy đủ những kiến thức từ cơ bản đến nâng cao, được trang bị những kiến thức chuyên môn chuyên ngành tạo tiền đề tốt nhất phục vụ vấn đề làm việc sau khi ra trường. Được trang bị những kỹ năng mềm, kỹ năng bảo vệ và chăm sóc sức khỏe cho người bệnh, giúp người bệnh phục hồi và khỏi bệnh nhanh chóng. Biết kiểm tra tình tạng bệnh nhân, kê toa thuốc, trị liệu... </li> </ul>",
            },
            {
                tab_name: "Thời gian đào tạo",
                content:
                    '<table class="table table-bordered"> <tbody> <tr> <td><p> </p></td> <td><strong>Năm thứ nhất</strong></td> </tr> <tr> <td><p>1</p></td> <td>Những NLCBCCN Mác – Lênin 1</td> </tr> <tr> <td><p>2</p></td> <td>Ngoại ngữ (Tiếng Anh I)</td> </tr> <tr> <td><p>3</p></td> <td>Tin học đại cương</td> </tr> <tr> <td><p>4</p></td> <td>Xác xuất – Thống kê y học</td> </tr> <tr> <td><p>5</p></td> <td>Hóa học đại cương</td> </tr> <tr> <td><p>6</p></td> <td>Sinh học và Di truyền</td> </tr> <tr> <td><p>7</p></td> <td>Hoá sinh</td> </tr> <tr> <td><p>8</p></td> <td>Vật lý và lý sinh</td> </tr> <tr> <td><p>9</p></td> <td>Những NLCBCCN Mác – Lênin 2</td> </tr> <tr> <td><p>10</p></td> <td>Ngoại ngữ (Tiếng Anh II)</td> </tr> <tr> <td><p>11</p></td> <td>Giải phẫu – Mô phôi</td> </tr> <tr> <td><p>12</p></td> <td>Sinh lý</td> </tr> <tr> <td><p>13</p></td> <td>Sức khoẻ - Nâng cao sức khoẻ & hành vi con người</td> </tr> <tr> <td><p>14</p></td> <td>Sức khỏe môi trường</td> </tr> <tr> <td><p>15</p></td> <td>Tâm lý y học – Đạo đức y học</td> </tr> <tr> <td><p>16</p></td> <td>Nghiên cứu khoa học 1</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ hai</strong></td> </tr> <tr> <td><p>17</p></td> <td>Đường lối cách mạng của Đảng Cộng sản Việt Nam</td> </tr> <tr> <td><p>18</p></td> <td>Ngoại ngữ (Tiếng Anh III)</td> </tr> <tr> <td><p>19</p></td> <td>Vi sinh y học</td> </tr> <tr> <td><p>20</p></td> <td>Ký sinh trùng</td> </tr> <tr> <td><p>21</p></td> <td>Pháp luật và Tổ chức Y tế</td> </tr> <tr> <td><p>22</p></td> <td>Dược lý</td> </tr> <tr> <td><p>23</p></td> <td>Sinh lý bệnh – Miễn dịch</td> </tr> <tr> <td><p>24</p></td> <td>Kỹ năng giao tiếp trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>25</p></td> <td>Tư tưởng Hồ Chí Minh</td> </tr> <tr> <td><p>26</p></td> <td>Dinh dưỡng - Tiết chế</td> </tr> <tr> <td><p>27</p></td> <td>Dịch tễ học</td> </tr> <tr> <td><p>28</p></td> <td>Giáo dục sức khoẻ trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>29</p></td> <td>Điều dưỡng cơ sở I</td> </tr> <tr> <td><p>30</p></td> <td>Điều dưỡng cơ sở II</td> </tr> <tr> <td><p>31</p></td> <td>Kiểm soát nhiễm khuẩn trong thực hành điều dưỡng</td> </tr> <tr> <td><p>32</p></td> <td>Y học cổ truyền</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ ba</strong></td> </tr> <tr> <td><p>33</p></td> <td>Điều dưỡng cơ sở III</td> </tr> <tr> <td><p>34</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa I</td> </tr> <tr> <td><p>35</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa II, III</td> </tr> <tr> <td><p>36</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa I</td> </tr> <tr> <td><p>37</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa II, III</td> </tr> <tr> <td><p>38</p></td> <td>Chăm sóc sức khoẻ trẻ em I, II</td> </tr> <tr> <td><p>39</p></td> <td>Sức khoẻ phụ nữ, bà mẹ, gia đình và chăm sóc điều dưỡng I, II</td> </tr> <tr> <td><p>40</p></td> <td>Chăm sóc sức khoẻ người cao tuổi</td> </tr> <tr> <td><p>41</p></td> <td>Chăm sóc người bệnh cấp cứu & chăm sóc tích cực</td> </tr> <tr> <td><p>42</p></td> <td>Chăm sóc người cần được phục hồi chức năng</td> </tr> <tr> <td><p>43</p></td> <td>Chăm sóc sức khoẻ cộng đồng</td> </tr> <tr> <td><p>44</p></td> <td>Quản lý điều dưỡng</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ tư</strong></td> </tr> <tr> <td><p>45</p></td> <td>Chăm sóc sức khỏe người bệnh truyền nhiễm</td> </tr> <tr> <td><p>46</p></td> <td>Chăm sóc sức khỏe tâm thần</td> </tr> <tr> <td><p>47</p></td> <td>Điều dưỡng chuyên khoa hệ nội</td> </tr> <tr> <td><p>48</p></td> <td>Điều dưỡng chuyên khoa hệ ngoại</td> </tr> <tr> <td><p>49</p></td> <td>Nghiên cứu khoa học 2</td> </tr> <tr> <td><p>50</p></td> <td>TT Điều dưỡng cộng đồng</td> </tr> <tr> <td><p>51</p></td> <td>Chuyên khoa tự chọn</td> </tr> <tr> <td><p>52</p></td> <td>Thực tế tốt nghiệp</td> </tr> <tr> <td><p> </p></td> <td><strong>TỐT NGHIỆP</strong></td> </tr> <tr> <td><p>53</p></td> <td>Thi tốt nghiệp hoặc khóa luận</td> </tr> </tbody> </table>',
            },
            {
                tab_name: "Đối tượng tuyển sinh",
                content:
                    "<p><strong>Hình thức tuyển sinh:</strong> <span>XÉT TUYỂN HỒ SƠ</span></p> <p><strong>Đối tượng tuyển sinh:</strong></p> <p><span>Thí sinh thuộc một trong các đối tượng sau sẽ đủ điều kiện trở thành sinh viên của Cao đẳng</span></p> <ul> <li><span>Tốt nghiệp THPT hoặc tương đương;</span></li> <li><span>Sinh viên hệ chính quy các trường Cao đẳng, Đại học.</span></li> <li><span>Sinh viên đã hoàn thành chương trình Trung cấp và đã có bằng tốt nghiệp THPT hoặc tương đương.</span></li> </ul>",
            },
            {
                tab_name: "Học phí",
                content:
                    "<div><p><strong>Học phí áp dụng từ 01/01/2023</strong></p><ul><li>Học phí kỳ định hướng đóng 01 lần duy nhất</li><li>Học phí chuyên ngành đã bao gồm tiếng Anh, có 6 kỳ chuyên ngành</li><li>Đơn vị tính: Việt Nam đồng</li></ul></div>",
            },
        ],
    },
    {
        name: "NGÀNH HỘ SINH",
        child: [
            {
                tab_name: "Chương trình",
                content:
                    "<ul> <li> <strong>Điều dưỡng</strong> (tiếng Anh là Nursing) là một nghề nghiệp trong hệ thống y tế nhằm bảo vệ, nâng cao, tối ưu về sức khỏe và các khả năng; dự phòng bệnh và chấn thương; thực hiện nhiệm vụ xoa dịu nỗi đau qua chẩn đoán và điều trị đáp ứng con người; tăng cường chăm sóc sức khỏe cho các cá nhân, gia đình, cộng đồng và xã hội. </li> <li> <strong>Mục tiêu </strong>của ngành Điều dưỡng đó là đào tạo, xây dựng đội ngũ nhân viên, sinh viên có ý thức tổ chức kỷ luật, có trách nhiệm trước sức khỏe của người dân, người bệnh. Có phẩm chất đạo đức tốt, có thái độ đúng đắn, có kiến thức khoa học cơ bản vững chắc. Có kiến thức và kỹ năng thực hành nghề theo tiêu chuẩn. Có kiến thức tốt về khoa học xã hội - khoa học tự nhiên - khoa học chuyên ngành về khối ngành chăm sóc sức khỏe của người bệnh và ngành điều dưỡng, từ đó chăm sóc người bệnh, nâng cao sức khỏe cho người bệnh. </li> <li> Theo học ngành này, sinh viên sẽ được trang bị đầy đủ những kiến thức từ cơ bản đến nâng cao, được trang bị những kiến thức chuyên môn chuyên ngành tạo tiền đề tốt nhất phục vụ vấn đề làm việc sau khi ra trường. Được trang bị những kỹ năng mềm, kỹ năng bảo vệ và chăm sóc sức khỏe cho người bệnh, giúp người bệnh phục hồi và khỏi bệnh nhanh chóng. Biết kiểm tra tình tạng bệnh nhân, kê toa thuốc, trị liệu... </li> </ul>",
            },
            {
                tab_name: "Thời gian đào tạo",
                content:
                    '<table class="table table-bordered"> <tbody> <tr> <td><p> </p></td> <td><strong>Năm thứ nhất</strong></td> </tr> <tr> <td><p>1</p></td> <td>Những NLCBCCN Mác – Lênin 1</td> </tr> <tr> <td><p>2</p></td> <td>Ngoại ngữ (Tiếng Anh I)</td> </tr> <tr> <td><p>3</p></td> <td>Tin học đại cương</td> </tr> <tr> <td><p>4</p></td> <td>Xác xuất – Thống kê y học</td> </tr> <tr> <td><p>5</p></td> <td>Hóa học đại cương</td> </tr> <tr> <td><p>6</p></td> <td>Sinh học và Di truyền</td> </tr> <tr> <td><p>7</p></td> <td>Hoá sinh</td> </tr> <tr> <td><p>8</p></td> <td>Vật lý và lý sinh</td> </tr> <tr> <td><p>9</p></td> <td>Những NLCBCCN Mác – Lênin 2</td> </tr> <tr> <td><p>10</p></td> <td>Ngoại ngữ (Tiếng Anh II)</td> </tr> <tr> <td><p>11</p></td> <td>Giải phẫu – Mô phôi</td> </tr> <tr> <td><p>12</p></td> <td>Sinh lý</td> </tr> <tr> <td><p>13</p></td> <td>Sức khoẻ - Nâng cao sức khoẻ & hành vi con người</td> </tr> <tr> <td><p>14</p></td> <td>Sức khỏe môi trường</td> </tr> <tr> <td><p>15</p></td> <td>Tâm lý y học – Đạo đức y học</td> </tr> <tr> <td><p>16</p></td> <td>Nghiên cứu khoa học 1</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ hai</strong></td> </tr> <tr> <td><p>17</p></td> <td>Đường lối cách mạng của Đảng Cộng sản Việt Nam</td> </tr> <tr> <td><p>18</p></td> <td>Ngoại ngữ (Tiếng Anh III)</td> </tr> <tr> <td><p>19</p></td> <td>Vi sinh y học</td> </tr> <tr> <td><p>20</p></td> <td>Ký sinh trùng</td> </tr> <tr> <td><p>21</p></td> <td>Pháp luật và Tổ chức Y tế</td> </tr> <tr> <td><p>22</p></td> <td>Dược lý</td> </tr> <tr> <td><p>23</p></td> <td>Sinh lý bệnh – Miễn dịch</td> </tr> <tr> <td><p>24</p></td> <td>Kỹ năng giao tiếp trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>25</p></td> <td>Tư tưởng Hồ Chí Minh</td> </tr> <tr> <td><p>26</p></td> <td>Dinh dưỡng - Tiết chế</td> </tr> <tr> <td><p>27</p></td> <td>Dịch tễ học</td> </tr> <tr> <td><p>28</p></td> <td>Giáo dục sức khoẻ trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>29</p></td> <td>Điều dưỡng cơ sở I</td> </tr> <tr> <td><p>30</p></td> <td>Điều dưỡng cơ sở II</td> </tr> <tr> <td><p>31</p></td> <td>Kiểm soát nhiễm khuẩn trong thực hành điều dưỡng</td> </tr> <tr> <td><p>32</p></td> <td>Y học cổ truyền</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ ba</strong></td> </tr> <tr> <td><p>33</p></td> <td>Điều dưỡng cơ sở III</td> </tr> <tr> <td><p>34</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa I</td> </tr> <tr> <td><p>35</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa II, III</td> </tr> <tr> <td><p>36</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa I</td> </tr> <tr> <td><p>37</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa II, III</td> </tr> <tr> <td><p>38</p></td> <td>Chăm sóc sức khoẻ trẻ em I, II</td> </tr> <tr> <td><p>39</p></td> <td>Sức khoẻ phụ nữ, bà mẹ, gia đình và chăm sóc điều dưỡng I, II</td> </tr> <tr> <td><p>40</p></td> <td>Chăm sóc sức khoẻ người cao tuổi</td> </tr> <tr> <td><p>41</p></td> <td>Chăm sóc người bệnh cấp cứu & chăm sóc tích cực</td> </tr> <tr> <td><p>42</p></td> <td>Chăm sóc người cần được phục hồi chức năng</td> </tr> <tr> <td><p>43</p></td> <td>Chăm sóc sức khoẻ cộng đồng</td> </tr> <tr> <td><p>44</p></td> <td>Quản lý điều dưỡng</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ tư</strong></td> </tr> <tr> <td><p>45</p></td> <td>Chăm sóc sức khỏe người bệnh truyền nhiễm</td> </tr> <tr> <td><p>46</p></td> <td>Chăm sóc sức khỏe tâm thần</td> </tr> <tr> <td><p>47</p></td> <td>Điều dưỡng chuyên khoa hệ nội</td> </tr> <tr> <td><p>48</p></td> <td>Điều dưỡng chuyên khoa hệ ngoại</td> </tr> <tr> <td><p>49</p></td> <td>Nghiên cứu khoa học 2</td> </tr> <tr> <td><p>50</p></td> <td>TT Điều dưỡng cộng đồng</td> </tr> <tr> <td><p>51</p></td> <td>Chuyên khoa tự chọn</td> </tr> <tr> <td><p>52</p></td> <td>Thực tế tốt nghiệp</td> </tr> <tr> <td><p> </p></td> <td><strong>TỐT NGHIỆP</strong></td> </tr> <tr> <td><p>53</p></td> <td>Thi tốt nghiệp hoặc khóa luận</td> </tr> </tbody> </table>',
            },
            {
                tab_name: "Đối tượng tuyển sinh",
                content:
                    "<p><strong>Hình thức tuyển sinh:</strong> <span>XÉT TUYỂN HỒ SƠ</span></p> <p><strong>Đối tượng tuyển sinh:</strong></p> <p><span>Thí sinh thuộc một trong các đối tượng sau sẽ đủ điều kiện trở thành sinh viên của Cao đẳng</span></p> <ul> <li><span>Tốt nghiệp THPT hoặc tương đương;</span></li> <li><span>Sinh viên hệ chính quy các trường Cao đẳng, Đại học.</span></li> <li><span>Sinh viên đã hoàn thành chương trình Trung cấp và đã có bằng tốt nghiệp THPT hoặc tương đương.</span></li> </ul>",
            },
            {
                tab_name: "Học phí",
                content:
                    "<div><p><strong>Học phí áp dụng từ 01/01/2023</strong></p><ul><li>Học phí kỳ định hướng đóng 01 lần duy nhất</li><li>Học phí chuyên ngành đã bao gồm tiếng Anh, có 6 kỳ chuyên ngành</li><li>Đơn vị tính: Việt Nam đồng</li></ul></div>",
            },
        ],
    },
    {
        name: "NGÀNH VẬT LÍ TRỊ LIỆU - PHỤC HỒI CHỨC NĂNG",
        child: [
            {
                tab_name: "Chương trình",
                content:
                    "<ul> <li> <strong>Điều dưỡng</strong> (tiếng Anh là Nursing) là một nghề nghiệp trong hệ thống y tế nhằm bảo vệ, nâng cao, tối ưu về sức khỏe và các khả năng; dự phòng bệnh và chấn thương; thực hiện nhiệm vụ xoa dịu nỗi đau qua chẩn đoán và điều trị đáp ứng con người; tăng cường chăm sóc sức khỏe cho các cá nhân, gia đình, cộng đồng và xã hội. </li> <li> <strong>Mục tiêu </strong>của ngành Điều dưỡng đó là đào tạo, xây dựng đội ngũ nhân viên, sinh viên có ý thức tổ chức kỷ luật, có trách nhiệm trước sức khỏe của người dân, người bệnh. Có phẩm chất đạo đức tốt, có thái độ đúng đắn, có kiến thức khoa học cơ bản vững chắc. Có kiến thức và kỹ năng thực hành nghề theo tiêu chuẩn. Có kiến thức tốt về khoa học xã hội - khoa học tự nhiên - khoa học chuyên ngành về khối ngành chăm sóc sức khỏe của người bệnh và ngành điều dưỡng, từ đó chăm sóc người bệnh, nâng cao sức khỏe cho người bệnh. </li> <li> Theo học ngành này, sinh viên sẽ được trang bị đầy đủ những kiến thức từ cơ bản đến nâng cao, được trang bị những kiến thức chuyên môn chuyên ngành tạo tiền đề tốt nhất phục vụ vấn đề làm việc sau khi ra trường. Được trang bị những kỹ năng mềm, kỹ năng bảo vệ và chăm sóc sức khỏe cho người bệnh, giúp người bệnh phục hồi và khỏi bệnh nhanh chóng. Biết kiểm tra tình tạng bệnh nhân, kê toa thuốc, trị liệu... </li> </ul>",
            },
            {
                tab_name: "Thời gian đào tạo",
                content:
                    '<table class="table table-bordered"> <tbody> <tr> <td><p> </p></td> <td><strong>Năm thứ nhất</strong></td> </tr> <tr> <td><p>1</p></td> <td>Những NLCBCCN Mác – Lênin 1</td> </tr> <tr> <td><p>2</p></td> <td>Ngoại ngữ (Tiếng Anh I)</td> </tr> <tr> <td><p>3</p></td> <td>Tin học đại cương</td> </tr> <tr> <td><p>4</p></td> <td>Xác xuất – Thống kê y học</td> </tr> <tr> <td><p>5</p></td> <td>Hóa học đại cương</td> </tr> <tr> <td><p>6</p></td> <td>Sinh học và Di truyền</td> </tr> <tr> <td><p>7</p></td> <td>Hoá sinh</td> </tr> <tr> <td><p>8</p></td> <td>Vật lý và lý sinh</td> </tr> <tr> <td><p>9</p></td> <td>Những NLCBCCN Mác – Lênin 2</td> </tr> <tr> <td><p>10</p></td> <td>Ngoại ngữ (Tiếng Anh II)</td> </tr> <tr> <td><p>11</p></td> <td>Giải phẫu – Mô phôi</td> </tr> <tr> <td><p>12</p></td> <td>Sinh lý</td> </tr> <tr> <td><p>13</p></td> <td>Sức khoẻ - Nâng cao sức khoẻ & hành vi con người</td> </tr> <tr> <td><p>14</p></td> <td>Sức khỏe môi trường</td> </tr> <tr> <td><p>15</p></td> <td>Tâm lý y học – Đạo đức y học</td> </tr> <tr> <td><p>16</p></td> <td>Nghiên cứu khoa học 1</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ hai</strong></td> </tr> <tr> <td><p>17</p></td> <td>Đường lối cách mạng của Đảng Cộng sản Việt Nam</td> </tr> <tr> <td><p>18</p></td> <td>Ngoại ngữ (Tiếng Anh III)</td> </tr> <tr> <td><p>19</p></td> <td>Vi sinh y học</td> </tr> <tr> <td><p>20</p></td> <td>Ký sinh trùng</td> </tr> <tr> <td><p>21</p></td> <td>Pháp luật và Tổ chức Y tế</td> </tr> <tr> <td><p>22</p></td> <td>Dược lý</td> </tr> <tr> <td><p>23</p></td> <td>Sinh lý bệnh – Miễn dịch</td> </tr> <tr> <td><p>24</p></td> <td>Kỹ năng giao tiếp trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>25</p></td> <td>Tư tưởng Hồ Chí Minh</td> </tr> <tr> <td><p>26</p></td> <td>Dinh dưỡng - Tiết chế</td> </tr> <tr> <td><p>27</p></td> <td>Dịch tễ học</td> </tr> <tr> <td><p>28</p></td> <td>Giáo dục sức khoẻ trong thực hành Điều dưỡng</td> </tr> <tr> <td><p>29</p></td> <td>Điều dưỡng cơ sở I</td> </tr> <tr> <td><p>30</p></td> <td>Điều dưỡng cơ sở II</td> </tr> <tr> <td><p>31</p></td> <td>Kiểm soát nhiễm khuẩn trong thực hành điều dưỡng</td> </tr> <tr> <td><p>32</p></td> <td>Y học cổ truyền</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ ba</strong></td> </tr> <tr> <td><p>33</p></td> <td>Điều dưỡng cơ sở III</td> </tr> <tr> <td><p>34</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa I</td> </tr> <tr> <td><p>35</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Nội khoa II, III</td> </tr> <tr> <td><p>36</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa I</td> </tr> <tr> <td><p>37</p></td> <td>Chăm sóc sức khoẻ người lớn bệnh Ngoại khoa II, III</td> </tr> <tr> <td><p>38</p></td> <td>Chăm sóc sức khoẻ trẻ em I, II</td> </tr> <tr> <td><p>39</p></td> <td>Sức khoẻ phụ nữ, bà mẹ, gia đình và chăm sóc điều dưỡng I, II</td> </tr> <tr> <td><p>40</p></td> <td>Chăm sóc sức khoẻ người cao tuổi</td> </tr> <tr> <td><p>41</p></td> <td>Chăm sóc người bệnh cấp cứu & chăm sóc tích cực</td> </tr> <tr> <td><p>42</p></td> <td>Chăm sóc người cần được phục hồi chức năng</td> </tr> <tr> <td><p>43</p></td> <td>Chăm sóc sức khoẻ cộng đồng</td> </tr> <tr> <td><p>44</p></td> <td>Quản lý điều dưỡng</td> </tr> <tr> <td><p> </p></td> <td><strong>Năm thứ tư</strong></td> </tr> <tr> <td><p>45</p></td> <td>Chăm sóc sức khỏe người bệnh truyền nhiễm</td> </tr> <tr> <td><p>46</p></td> <td>Chăm sóc sức khỏe tâm thần</td> </tr> <tr> <td><p>47</p></td> <td>Điều dưỡng chuyên khoa hệ nội</td> </tr> <tr> <td><p>48</p></td> <td>Điều dưỡng chuyên khoa hệ ngoại</td> </tr> <tr> <td><p>49</p></td> <td>Nghiên cứu khoa học 2</td> </tr> <tr> <td><p>50</p></td> <td>TT Điều dưỡng cộng đồng</td> </tr> <tr> <td><p>51</p></td> <td>Chuyên khoa tự chọn</td> </tr> <tr> <td><p>52</p></td> <td>Thực tế tốt nghiệp</td> </tr> <tr> <td><p> </p></td> <td><strong>TỐT NGHIỆP</strong></td> </tr> <tr> <td><p>53</p></td> <td>Thi tốt nghiệp hoặc khóa luận</td> </tr> </tbody> </table>',
            },
            {
                tab_name: "Đối tượng tuyển sinh",
                content:
                    "<p><strong>Hình thức tuyển sinh:</strong> <span>XÉT TUYỂN HỒ SƠ</span></p> <p><strong>Đối tượng tuyển sinh:</strong></p> <p><span>Thí sinh thuộc một trong các đối tượng sau sẽ đủ điều kiện trở thành sinh viên của Cao đẳng</span></p> <ul> <li><span>Tốt nghiệp THPT hoặc tương đương;</span></li> <li><span>Sinh viên hệ chính quy các trường Cao đẳng, Đại học.</span></li> <li><span>Sinh viên đã hoàn thành chương trình Trung cấp và đã có bằng tốt nghiệp THPT hoặc tương đương.</span></li> </ul>",
            },
            {
                tab_name: "Học phí",
                content:
                    "<div><p><strong>Học phí áp dụng từ 01/01/2023</strong></p><ul><li>Học phí kỳ định hướng đóng 01 lần duy nhất</li><li>Học phí chuyên ngành đã bao gồm tiếng Anh, có 6 kỳ chuyên ngành</li><li>Đơn vị tính: Việt Nam đồng</li></ul></div>",
            },
        ],
    },
];
</script>

<template>
    <Head title="Chương trình đào tạo" />
    <App>
        <template #header>
            <div class="card text-white p-0">
                <img
                    alt="Card image cap"
                    src="/storage/images/banner/banner-dao-tao.jpg"
                    width="100%"
                    class="card-img border-noround"
                />
                <div
                    class="d-flex align-items-center justify-content-center card-img-overlay"
                >
                    <div
                        class="p-3"
                        style="background-color: rgba(39, 76, 53, 0.46)"
                    >
                        <h1 class="card-title font-bold">
                            CHƯƠNG TRÌNH ĐÀO TẠO
                        </h1>
                    </div>
                </div>
            </div>
        </template>

        <div class="container mx-auto">
            <div
                class="col-12"
                v-for="training in trainings"
                :key="training.name"
            >
                <h3
                    class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                >
                    {{ training.name }}
                </h3>
                <TabView ref="tabview1">
                    <TabPanel
                        v-for="tab in training.child"
                        :key="tab.tab_name"
                        :header="`${tab.tab_name}`"
                    >
                        <div v-html="tab.content"></div>
                    </TabPanel>
                </TabView>
            </div>
        </div>
    </App>
</template>
