<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>منصة فرصتك للتوظيف</title>
    <style>
        /* حركة التنقل الناعمة */
        html { scroll-behavior: smooth; }
        
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; color: #333; }
        .container { width: 85%; margin: auto; max-width: 1200px; }
        
        /* الهيدر */
        .header-sec { background: #2c3e50; padding: 15px 0; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .header-container { display: flex; justify-content: space-between; align-items: center; }
        .logo { color: white; font-size: 1.6rem; font-weight: bold; text-decoration: none; }
        .header-sec nav ul { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
        .header-sec nav ul li a { color: #f8f9fa; text-decoration: none; font-size: 1rem; transition: 0.3s; }
        .header-sec nav ul li a:hover { color: #3498db; }
        
        
        .landing { 
            position: relative; 
            width: 100%; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            background-image: linear-gradient(rgba(0,30,60,0.7), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1560250056-07ba64664864?q=80&w=1600'); 
            background-size: cover; 
            background-position: center 20%; 
            color: white; 
            text-align: center; 
        }
        .landing h1 { font-size: 3.5rem; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-weight: bold; }
        .landing p { font-size: 1.3rem; max-width: 700px; margin: 0 auto 40px; line-height: 1.8; color: #f1f2f6; text-shadow: 1px 1px 3px rgba(0,0,0,0.3); }
        .landing button { padding: 14px 35px; background-color: #3498db; color: white; border: none; border-radius: 30px; font-size: 1.2rem; cursor: pointer; font-weight: bold; transition: 0.3s; box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4); }
        .landing button:hover { background-color: #2980b9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(52, 152, 219, 0.6); }
        
      
        .section-title { text-align: center; margin-bottom: 50px; font-size: 2.4rem; color: #2c3e50; position: relative; padding-bottom: 15px; }
        .section-title::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background-color: #3498db; border-radius: 2px; }
        
        .grid-layout { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid #eef2f5; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        
        .btn-details { padding: 10px 25px; background: #2c3e50; color: white; border: none; border-radius: 5px; cursor: pointer; transition: 0.3s; text-decoration: none; display: inline-block; margin-top: 15px; }
        .btn-details:hover { background: #3498db; }
    </style>
</head>
<body>

    <!-- الهيدر -->
    <header class="header-sec">
        <div class="container header-container">
            <a href="#home" class="logo">منصة فرصتك</a>
            <nav>
                <ul>
                    <li><a href="#home">الرئيسية</a></li>
                    <li><a href="jobs.php">الوظائف المتاحة</a></li>
                    <li><a href="#parents">قصص النجاح</a></li>
                    <li><a href="#news">أخبار السوق</a></li>
                    <li><a href="#about">من نحن</a></li>
                    <li><a href="#contact">اتصل بنا</a></li>
                    <li><a href="login.php" style="background: #3498db; padding: 5px 15px; border-radius: 20px;">الدخول</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- قسم الرئيسية -->
    <section id="home" class="landing">
        <div class="container">
            <div class="Content">
                <h1>منصة "فرصتك" للتوظيف</h1>
                <p>بوابتك الذكية لربط الكفاءات الطموحة بأبرز الشركات لفتح آفاق جديدة للمستقبل المهني.</p>
                <a href="jobs.php"><button>تصفح الوظائف المتاحة</button></a>
            </div>
        </div>
    </section>

    <!-- قسم أحدث الوظائف -->
    <section id="jobs-section" style="padding: 80px 0; background: #fff;">
        <div class="container">
            <h2 class="section-title">أحدث الوظائف المتاحة</h2>
            <div class="grid-layout">
                <div class="card" style="text-align: center;">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=600" style="width: 100%; height: 200px; object-fit: cover; border-bottom: 3px solid #3498db;">
                    <div style="padding: 25px;">
                        <h3 style="margin: 0 0 10px 0; color: #2c3e50;">مطور واجهات ويب (Frontend)</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">مطلوب للعمل بشركة تقنية كبرى لبناء وتطوير واجهات مستخدم متجاوبة وجذابة باستخدام أحدث التقنيات.</p>
                        <a href="jobs.php" class="btn-details">عرض التفاصيل</a>
                    </div>
                </div>
                <div class="card" style="text-align: center;">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600" style="width: 100%; height: 200px; object-fit: cover; border-bottom: 3px solid #2ecc71;">
                    <div style="padding: 25px;">
                        <h3 style="margin: 0 0 10px 0; color: #2c3e50;">محلل بيانات ومدير مشاريع</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">مطلوب محترف في تنظيم وتحليل البيانات وإدارة الجداول الزمنية للمشاريع الرقمية بكفاءة عالية.</p>
                        <a href="jobs.php" class="btn-details">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم أخبار السوق -->
    <section id="news" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <h2 class="section-title">أخبار السوق</h2>
            <div class="grid-layout">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=600" style="width: 100%; height: 220px; object-fit: cover;">
                    <div style="padding: 25px;">
                        <h3 style="margin-top: 0; color: #2c3e50;">انطلاق ملتقى التوظيف الرقمي الجديد</h3>
                        <p style="color: #666; line-height: 1.6;">أكبر تجمع افتراضي يربط بين الخريجين والشركات الناشئة والمؤسسات لتقديم فرص عمل متميزة.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=600" style="width: 100%; height: 220px; object-fit: cover;">
                    <div style="padding: 25px;">
                        <h3 style="margin-top: 0; color: #2c3e50;">المهارات الأكثر طلباً في سوق العمل</h3>
                        <p style="color: #666; line-height: 1.6;">دراسات حديثة تكشف عن تصدر المهارات الرقمية والتحليلية قائمة المتطلبات الأساسية للتوظيف.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم قصص النجاح -->
    <section id="parents" style="padding: 80px 0; background: #fff;">
        <div class="container">
            <h2 class="section-title">قصص النجاح</h2>
            <div style="display: flex; gap: 40px; justify-content: center; flex-wrap: wrap;">
                <div class="card" style="width: 320px; padding: 35px; text-align: center;">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=200" style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid #3498db; margin-bottom: 20px; object-fit: cover;">
                    <h4 style="margin: 0; font-size: 1.25rem; color: #2c3e50;">محمد عوض</h4>
                    <p style="color: #888; font-size: 0.9rem; margin: 5px 0 15px;">مدير مشاريع تقنية</p>
                    <p style="font-style: italic; color: #555; line-height: 1.6;">"بفضل منصة فرصتك، اختصرت شهوراً من البحث الطويل، وحصلت على وظيفتي الأولى في غضون أسبوعين فقط!"</p>
                </div>
                <div class="card" style="width: 320px; padding: 35px; text-align: center;">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=200" style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid #3498db; margin-bottom: 20px; object-fit: cover;">
                    <h4 style="margin: 0; font-size: 1.25rem; color: #2c3e50;">سندس عوض</h4>
                    <p style="color: #888; font-size: 0.9rem; margin: 5px 0 15px;">مهندسة برمجيات</p>
                    <p style="font-style: italic; color: #555; line-height: 1.6;">"تجربة الاستخدام كانت في غاية السلاسة، المنصة ساعدتني في إيصال معرض أعمالي لكبرى الشركات."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم من نحن -->
    <section id="about" style="padding: 80px 0; background: #f8f9fa; text-align: center;">
        <div class="container">
            <h2 class="section-title">من نحن</h2>
            <p style="max-width: 800px; margin: auto; font-size: 1.1rem; line-height: 1.8; color: #555;">
                نحن منصة "فرصتك"، نهدف إلى سد الفجوة بين الكفاءات المهنية واحتياجات سوق العمل المتطورة. 
                نؤمن بأن كل شخص يمتلك مهارات فريدة تستحق أن تُكتشف، لذلك نوفر بيئة رقمية متطورة وسهلة الاستخدام 
                لتسهيل عملية التوظيف وجعلها أكثر شفافية وفعالية للجميع.
            </p>
        </div>
    </section>

    <!-- قسم اتصل بنا (الفوتر) -->
    <footer id="contact" style="background: #2c3e50; color: white; text-align: center; padding: 60px 0; border-top: 5px solid #3498db;">
        <div class="container">
            <h2 style="margin-bottom: 20px;">اتصل بنا</h2>
            <p style="color: #bdc3c7; font-size: 1.1rem; margin-bottom: 10px;">نحن هنا لمساعدتك والإجابة على كافة استفساراتك</p>
            <p style="color: #3498db; font-size: 1.2rem; font-weight: bold; margin-bottom: 30px;">support@jobsplatform.com</p>
            
            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                <p style="color: #7f8c8d; font-size: 0.9rem; margin: 0;">جميع الحقوق محفوظة &copy; 2026 منصة فرصتك للتوظيف</p>
            </div>
        </div>
    </footer>

</body>
</html>