require 'test_helper'

class CommentTest < ActiveSupport::TestCase
  def setup
    @comment = comments(:comment_1)
  end

  test 'user, created_at and content should be present, content not longer then 500' do
    assert @comment.valid?

    @comment.user = nil
    assert_not @comment.valid?
    @comment.user = users(:user_1)

    @comment.created_at = nil
    assert_not @comment.valid?
    @comment.created_at = Date.new

    @comment.content = nil
    assert_not @comment.valid?
    @comment.content = 'a'*501
    assert_not @comment.valid?
    @comment.content = 'smthg'

    assert @comment.valid?
  end
end
