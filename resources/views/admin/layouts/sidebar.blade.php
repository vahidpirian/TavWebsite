<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

{{--            <a href="" class="sidebar-link" target="_blank">--}}
{{--                <i class="fas fa-shopping-cart"></i>--}}
{{--                <span>سایت</span>--}}
{{--            </a>--}}

{{--            <hr>--}}


            <a href="{{ route('admin.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <a href="{{ route('admin.contact.index') }}" class="sidebar-link">
                <i class="fas fa-comment"></i>
                <span>تماس باما</span>
            </a>


            <section class="sidebar-part-title">بخش محتوی</section>

            <a href="{{ route('admin.content.category.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>دسته بندی</span>
            </a>


            <a href="{{ route('admin.content.post.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>پست ها</span>
            </a>
            <a href="{{ route('admin.content.comment.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>نظرات</span>
            </a>
            <a href="{{ route('admin.content.menu.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>منو</span>
            </a>
            <a href="{{ route('admin.content.faq.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>سوالات متداول</span>
            </a>
            <a href="{{ route('admin.content.page.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>پیج ساز</span>
            </a>
            <a href="{{ route('admin.content.banner.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>بنر ها</span>
            </a>

            <a href="{{ route('admin.content.company-statistic.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>آمار ها</span>
            </a>

            <a href="{{ route('admin.content.service.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>خدمات ها</span>
            </a>
            <a href="{{ route('admin.content.project.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>پروژه ها</span>
            </a>

            <a href="{{ route('admin.content.image.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تصویر ها</span>
            </a>
            <a href="{{ route('admin.content.video.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>ویدیو ها</span>
            </a>

            <section class="sidebar-part-title">بخش کاربران</section>
            <a href="{{ route('admin.user.admin-user.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>کاربران ادمین</span>
            </a>
            <a href="{{ route('admin.user.customer.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>کاربران</span>
            </a>


            <section class="sidebar-part-title">تیکت ها</section>
            <a href="{{ route('admin.ticket.category.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span> دسته بندی تیکت ها </span>
            </a>
            <a href="{{ route('admin.ticket.priority.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span> اولویت تیکت ها </span>
            </a>
            <a href="{{ route('admin.ticket.admin.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span> ادمین تیکت ها </span>
            </a>
            <a href="{{ route('admin.ticket.newTickets') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تیکت های جدید</span>
            </a>
            <a href="{{ route('admin.ticket.openTickets') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تیکت های باز</span>
            </a>
            <a href="{{ route('admin.ticket.closeTickets') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تیکت های بسته</span>
            </a>

            <a href="{{ route('admin.ticket.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>همه ی تیکت ها</span>
            </a>



            <section class="sidebar-part-title">اطلاع رسانی</section>
            <a href="{{ route('admin.notify.sms.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>اعلامیه پیامکی</span>
            </a>



            <section class="sidebar-part-title">تنظیمات</section>
            <a href="{{ route('admin.setting.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تنظیمات</span>
            </a>

        </section>
    </section>
</aside>
